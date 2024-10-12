<a name="oben"></a>

<div align="center">

|[:skull:ISSUE](https://github.com/frankyhub/Bike-Counter/issues?q=is%3Aissue)|[:speech_balloon: Forum /Discussion](https://github.com/frankyhub/Bike-Counter/discussions)|[:grey_question:WiKi](https://github.com/frankyhub/Bike-Counter/wiki)||
|--|--|--|--|
| | | | |
|![Static Badge](https://img.shields.io/badge/RepoNr.:-%2064-blue)|<a href="https://github.com/frankyhub/Bike-Counter/issues">![GitHub issues](https://img.shields.io/github/issues/frankyhub/Bike-Counter)![GitHub closed issues](https://img.shields.io/github/issues-closed/frankyhub/Bike-Counter)|<a href="https://github.com/frankyhub/Bike-Counter/discussions">![GitHub Discussions](https://img.shields.io/github/discussions/frankyhub/Bike-Counter)|<a href="https://github.com/frankyhub/Bike-Counter/releases">![GitHub release (with filter)](https://img.shields.io/github/v/release/frankyhub/Bike-Counter)|
|![GitHub Created At](https://img.shields.io/github/created-at/frankyhub/Bike-Counter)| <a href="https://github.com/frankyhub/Bike-Counter/pulse" alt="Activity"><img src="https://img.shields.io/github/commit-activity/m/badges/shields" />| <a href="https://github.com/frankyhub/Bike-Counter/graphs/traffic"><img alt="ViewCount" src="https://views.whatilearened.today/views/github/frankyhub/github-clone-count-badge.svg">  |<a href="https://github.com/frankyhub?tab=stars"> ![GitHub User's stars](https://img.shields.io/github/stars/frankyhub)|
</div>



# Bike-Counter

## Story
Der Bike-Counter zählt Bikes auf einer Nebenstraße in zwei unterschiedlichen Richtungen und sendet die Zählerstände an eine SQL-Datenbank. Es sollen nur Bikes gezählt werden und keine Fußgänger oder andere Fahrzeuge. Mit einem Dashboard werden die Zählerstände der Bikes angezeigt. Eine Auswertung zeigt die Durchfahrt der Bikes innerhalb der letzten 24 Stunden. Für die Erfassung der Bikes werden 2 Lichtschranken verwendet.

Vorteile des Bike-Counters: 
+ Verwendung von handelsüblichen Sensoren (Drucksensor, Lichtschranke ...)
+ Richtungserkennung der Fahrräder
+ Zählerstände auf einem Dashboard visualisiert
+ Auswertung der Bewegungen der letzten 24h
+ Nutzung der kostenlosen SQL-Datenbank des Providers (Strato)

## Hardware
+ 1 x ESP32
+ 2 x Lichtschranken PEM2D
+ 1 x Platine (Richtungserkennung)

## Software
+ Die Zählimpulse der Lichtschranken werden von der "Richtungserkennung-Platine" aufbereitet.
+ Der ESP32 übermittelt die Zählerstände an das PHP-Programm "post-data.php".
+ Die Zählerstände werden in einer SQL-Datenbank gespeichert und mit dem Dashboard "hoki-counter.php angezeigt.
+ Eine 24h-Auswertung kann mit dem Programm "auswertung.php" erfolgen.


![Bild](pic/Sensor-Schema.png)

![Bild](pic/Hoki-Bike-Counter-Impulsdiagramm.png)

![Bild](pic/RichtungserkennungV4.png)

![Bild](pic/Richtungserkennung.png)

![Bild](pic/Dashboard.png)

![Bild](pic/Auswertung.png)

---

<div style="position:absolute; left:2cm; ">   
<ol class="breadcrumb" style="border-top: 2px solid black;border-bottom:2px solid black; height: 45px; width: 900px;"> <p align="center"><a href="#oben">nach oben</a></p></ol>
</div>  

---
