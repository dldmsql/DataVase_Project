// Library
#include <DHT.h>
#include <DigitShield.h>
#include <SoftwareSerial.h>

// initialize
#define rxPin 12 // BT rx
#define txPin 13 // BT tx

#define DHTPIN 12 // 온습도 센서 12번에 연결
#define DHTTYPE DHT11

SoftwareSerial.BTSerial(rxPin, txPin);
char rcv_data; // BT를 통해 받은 값

DHT dht(DHTPIN, DHTTYPE); // DHT 설정

int motor = 10;
int water = 0;

void setup() {
Serial.begin(9600);
BTSerial.begin(9600);
DigitShield.begin();
dht.begin();
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
  Serial.println("C");
  DigitShield.setValue(t);
  delay(500);
  water = analogRead(A3);
  Serial.print("Soil humidity: ");
  Serial.println(water);
  DigitShield.setValue(water);

if(BTSerial.available()){
  rcv_data = BTSerial.read();
  if(rcv_dat== 'd') // d 입력 시 실행
  {
    BTSerial.write(h);
    BTSerial.write(t);
    BTSerial.write(water);
    }
    if(water <= 900) {
  Serial.println("wet");
  digitalWrite(motor, LOW);
    }
    else {
  Serial.println("dry");
  digitalWrite(motor, HIGH);
   }
  }  
 }
