/* ESP32 Bike-Counter HOKI  frankyhub.de
 *  V1 28.06.2021 / 
 *  Board: ESP32vn IoT UNO
 *  Einstellungen:  https://dl.espressif.com/dl/package_esp32_index.json
 *                  C:\Users\User\Documents\Arduino\libraries
 */


#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif

#include <Wire.h>
#include <Adafruit_Sensor.h>


const char* ssid = " ";
const char* password = " ";

const char* serverName = "http://frankyhub.de/hokidata/post-data.php";

String apiKeyValue = "tPmAT5Ab3j7F9";
String sensorName = "Counter 1";
String sensorLocation = "Thanner Str.";



//--------Sensor 1 und 2 --------------------------------
int Ta1 = 25; //Sensor b Imp 1a (Platine Impulsaufbereitung)
int Ts1 = 0; // Status des Sensors 
int L1 = 17; //LED Impuls vom Sensor b

int Ta2 = 16; //Sensor c Imp 2a (Platine Impulsaufbereitung)
int Ts2 = 0; // Status des Sensors
int L2 = 27; //LED 2 Impuls vom Sensor c

int Ld = 26; //Zählimpuls Richtung d

int Le = 12; //Zählimpuls Richtung e
//----------------------------------------

//--------Richtung d oder e --------------------------------

int Rd = 18; //Richtung d Imp 1a (Platine Richtungserkennung)
int Rds = 0; // Status Richtung d 
int Re = 19; //Richtung e Imp 2a (Platine Richtungserkennung)
int Rde = 0; // Status Richtung e
//----------------------------------------


 //Counter d Richtung Thann
int countd = 1370;//----------------------------------------//--------------- Datenbankwert aktualiesieren ! -------------------------//----------------------------------------
String count_d;
//----------------------------------------



 //Counter e Richtung Hoki
int counte = 1410;//----------------------------------------//---------------- Datenbankwert aktualiesieren ! -----------------------//----------------------------------------
String count_e;
//----------------------------------------


//----------Sendeintervalle (1h) ------------------------------
unsigned long lastTime = 0;
// Timer für 10 Minuten (600000)
//unsigned long timerDelay = 600000;
// Timer für 30 Sekunden (30000)
//unsigned long timerDelay = 10000;
// Timer für 1h:3 600 000
unsigned long timerDelay = 3598900; //-------------------------------------------28.06.2021------------------------//----------------------------------------

void setup() {
  
  //-----------------------------------------
  pinMode(Ta1, INPUT_PULLUP); 
  pinMode(L1, OUTPUT);      
  //-----------------------------------------

  //-----------------------------------------
  pinMode(Ta2, INPUT_PULLUP); 
  pinMode(L2, OUTPUT);      
  //-----------------------------------------
  pinMode(Ld, OUTPUT);
  pinMode(Le, OUTPUT);  
  //-----------------------------------------
  pinMode(Rd, INPUT);
  pinMode(Re, INPUT);  
  //----------------------------------------- 
  Serial.begin(115200);

  //-------WiFi ----------------------------------
  WiFi.begin(ssid, password);
  Serial.println("Verbunden");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Verbunden mit WiFi IP Addresse: ");
  Serial.println(WiFi.localIP());

  
  Serial.println("Timer ist auf 1h eingestellt (timerDelay-Variable), es dauert 1h, bis die erste Lesung veröffentlicht wird.");


//------------------------------------------- Post nach Reset ---------------------------------------------
HTTPClient http;

      // Domain Name
      http.begin(serverName);

      // Header
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");

      // Vorbereiten der HTTP POST-Anforderungsdaten
      String httpRequestData = "api_key=" + apiKeyValue + "&sensor=" + sensorName
                            + "&location=" + sensorLocation + "&value1=" + countd+ "&value2=" + counte;
     
      Serial.print("httpRequestData: ");
      Serial.println(httpRequestData);
      int httpResponseCode = http.POST(httpRequestData);
      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
      }  
}

//------------------------------------------------------------------------------------------------------------
void loop() {

//-----------------------------------------  

  count_d =  String(countd);
  count_e =  String(counte);
  
//-----------------------------------------

//-------- Sensor b ---------------------------------
  Ts1 = digitalRead(Ta1);
  delay(5);
     if (Ts1 == HIGH) 
     {     
    digitalWrite(L1, HIGH);
     }
                else  
                {
                digitalWrite(L1, LOW);
                }
                
  //-------- Sensor c ---------------------------------
  Ts2 = digitalRead(Ta2);
  delay(5);
     if (Ts2 == HIGH) 
     {     
    digitalWrite(L2, HIGH);
     }
                else  
                {
                digitalWrite(L2, LOW);
                }

//------- Richtung einlesen ----------------------------------

  Rds = digitalRead(Rd);
  delay(5);

//------------------------------------------------------------
  Rde = digitalRead(Re);
  delay(5);


  //---------- Zähler d -------------------------------
                if(Ts1 == 1 && Ts2 == 1 && Rds == 1)
                //if(Ts1 == 1 && Ts2 == 1)
                {
                countd++;
                digitalWrite(Ld, HIGH);
                Serial.println ("Zählerstand Richtung d (Thann): ");
                Serial.println(count_d);
                delay(500);
                digitalWrite(Ld, LOW);
                }

//-----------------------------------------

  //---------- Zähler e -------------------------------
                if(Ts1 == 1 && Ts2 == 1 && Rde == 1)
                {
                counte++;
                digitalWrite(Le, HIGH);
                Serial.println ("Zählerstand Richtung e (Hoki): ");
                Serial.println(count_e);
                delay(500);
                digitalWrite(Le, LOW);
                }

//-----------------------------------------
  
  //---------- HTTP POST ----------------------
  if ((millis() - lastTime) > timerDelay) {
    //Check WiFi connection status
    if(WiFi.status()== WL_CONNECTED){
      HTTPClient http;

      // Domain Name
      http.begin(serverName);

      // Header
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");

      // Vorbereiten der HTTP POST-Anforderungsdaten
      String httpRequestData = "api_key=" + apiKeyValue + "&sensor=" + sensorName
                            + "&location=" + sensorLocation + "&value1=" + countd + "&value2=" + counte;
     
       
      Serial.print("httpRequestData: ");
      Serial.println(httpRequestData);



      // HTTP POST-Anforderung senden
      int httpResponseCode = http.POST(httpRequestData);

      if (httpResponseCode>0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
      }
      else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }
      // Free resources
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
    lastTime = millis();
  }
}