//Reduzierung Adapter-grüner Schlauch
$fn=130;

include <ma_lib/constants.scad>
use <ma_lib/shapes.scad>


r1=4;
r2=3.6;


color([0.2, 0.2, 1])
difference (){
union() {
//translate([0, 0, -2])
//rotate([180,0,0])
//cyl(l=8, d1=15, d2=12, 
//chamfer1=1.5, chamfang1=10,
//from_end=true, fillet2=2);
translate([0, 0, 20])
cylinder (3, r1, r2);
translate([0, 0, 17])
cylinder (3, r1, r2);
translate([0, 0, 14])
cylinder (3, r1, r2);
translate([0, 0, 11])
cylinder (3, r1, r2);
translate([0, 0, 8])
cylinder (3, r1, r2);
translate([0, 0, 5])
cylinder (3, r1, r2);
translate([0, 0, 2])
cylinder (3, r1, r2);
translate([0, 0, -1])
cylinder (3, r1, r2);
translate([0, 0, -4])
cylinder (3, r1, r2);
translate([0, 0, -7])
cylinder (3, r1, r2);    
translate([0, 0, -10])
cylinder (3, r1, r2);
translate([0, 0, -13])
cylinder (3, r1, r2);    
    
    
    
    
    
    
}
translate([0, 0, -15])
cylinder (40, d1=6, d2=6);
}

