//Druckschlauch-Stoepsel
$fn=130;

include <ma_lib/constants.scad>
use <ma_lib/shapes.scad>

color([0.2, 0.2, 1])

union() {
translate([0, 0, -2])
rotate([180,0,0])
cyl(l=8, d1=15, d2=12, 
chamfer1=1.5, chamfang1=10,
from_end=true, fillet2=2);
translate([0, 0, 20])
cylinder (3, d1=6, d2=4);
translate([0, 0, 17])
cylinder (3, d1=6.4, d2=5);
translate([0, 0, 14])
cylinder (3, d1=6.4, d2=5);
translate([0, 0, 11])
cylinder (3, d1=6.4, d2=5);
translate([0, 0, 8])
cylinder (3, d1=6.4, d2=5);
translate([0, 0, 5])
cylinder (3, d1=6.4, d2=5);
translate([0, 0, 2])
cylinder (3, d1=5.7, d2=5);
}


