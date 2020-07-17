// Library
#include <DHT.h>
#include <DigitShield.h>
#include <SoftwareSerial.h>

// initialize
#define rxPin 8 // BT rx
#define txPin 7 // BT tx

#define DHTPIN 12 // 온습도 센서 12번에 연결
#define DHTTYPE DHT11

SoftwareSerial BTSerial(rxPin, txPin);
char rcv_data; // BT를 통해 받은 값

DHT dht(DHTPIN, DHTTYPE); // DHT 설정

int motor = 10; // motor pump pin 10번
int water = 0; // water 변수 0으로 초기화
int isInit = 0;

// pre_Value
float preH = 0;
float preT = 0;

void setup() {
Serial.begin(9600);
BTSerial.begin(9600);
DigitShield.begin();
dht.begin();
pinMode(motor,OUTPUT);
}

void loop() {
  delay(500);
  float h = dht.readHumidity(); // 습도값 저장
  float t = dht.readTemperature(); // 온도값 저장
  float f = dht.readTemperature(true); // 화씨 온도 측정
  float hif = dht.computeHeatIndex(f,h);
  float hic = dht.computeHeatIndex(t,h,false);
//  Serial.print("Humidity: ");
//  Serial.print(h);
//  Serial.print("% ");
  DigitShield.setValue(h);
  delay(500);
//  Serial.print("Temperature: ");
//  Serial.print(hic);
//  Serial.println("C");
  DigitShield.setValue(t);
  delay(500);
  water = analogRead(A3); // 토양 습도 체크
//  Serial.print("Soil humidity: ");
//  Serial.println(water);
  DigitShield.setValue(water);
  
  // connect with Android
    if(isInit == 0){
      checkConnect();
    }
    delay(1000);

    // send data to Android
    Serial.println("");
    Serial.println(h);
    Serial.println(t);
    Serial.println(water);

   if(water > 1000){
    BTSerial.println(h);
    BTSerial.println(t);
    BTSerial.println(water);
   }
    
    delay(1000);
    
  if(BTSerial.available()){ // receive data from Android
   rcv_data = BTSerial.read();
  // control the water pump
  if(rcv_data == 'n')
  {
   Serial.println("Moter ON");
   digitalWrite(motor, HIGH); // ON
   delay(1000);
   digitalWrite(motor, LOW); // OFF
    }
 
  }
    
 }
 void checkConnect(){
  
  if(BTSerial.available()){
   Serial.write(BTSerial.read()); // Android connect success!
   isInit = 1;
  }
  }
