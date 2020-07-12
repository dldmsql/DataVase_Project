// Library
#include <DHT.h>
#include <DigitShield.h>

// initialize
#define DHTPIN 12 // 온습도 센서 12번에 연결
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE); // DHT 설정

int motor = 10;
int water = 0;

void setup() {
Serial.begin(9600);
DigitShield.begin();
dth.begin();
// Serial.begin(9600);
pinMode(motor,OUTPUT);

}

void loop() {
  delay(500);
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  float f = dht.readTemperature(true); // 화시 온도 측정
  float hif = dht.computeHeatIndex(f,h);
  float hic = dht.computeHeatIndex(t,h,false);
  Serial.print("Humidity: ");
  Serial.print("% ");
  DigitShield.setValue(h);
  delay(500);
  Serial.print("Temperature: ");
  Serial.print(hic);
  Serail.println("C");
  DigitShield.setValue(t);
  delay(500);
  water = analogRead(A3);
  Serial.print("Soil humidity: ");
  Serial.println(water);
  DigitShield.setValue(water);

  if(sensor <= 900) {
  Serial.println("wet");
  digitalWrite(motor, Low);
    }
    else {
  Serial.println("dry");
  digitalWrite(motor, HIGH);
   }
 }
