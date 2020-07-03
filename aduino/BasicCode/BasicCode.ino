// initialize
#define AnalogPin 0
int sensor = 0; // store and read data from sensor
int pump = 13; // operate pump pin Num

void setup() {
Serial.begin(9600);
pinMode(pump,OUTPUT);

}

void loop() {
sensor = analogRead(AnalogPin);
Serial.print("sensor : ");
Serial.println(sensor); // print value 0 ~ 1023
if(sensor <= 900) {
  Serial.println("wet");
  digitalWrite(pump, HIGH);
    }
else {
  Serial.println("dry");
  digitalWrite(pump, LOW);
  delay(1000);
  }
  delay(3000);
}
