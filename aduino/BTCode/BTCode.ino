// initialize
#include <SoftwareSerial.h>
#define rxPin 12 // BT rx
#define txPin 13 // BT tx

#define AnalogPin 0
int sensor = 0; // store and read data from sensor
int pump = 13; // operate pump pin Num

SoftwareSerial.BTSerial(rxPin,txPin);
char rcv_data; // BT를 통해 받은 값

void setup() {
Serial.begin(9600);
BTSerail.begin(9600);
pinMode(pump,OUTPUT);

}

void loop() {
  if(BTSerial.available()){ // 수신여부 체크
    rcv_data = BTSerial.read();
    if(rcv_Data == 'd') // 스마트폰에서 'd' 입력 시 실행
    {
      sensor = map(analogRead(AnalogPin), 0, 1023, 0, 1023); // 변수에 센서값 저장
      Serial.print("sensor : ");
      Serial.println(sensor); // print value 0 ~ 1023
      BTSerial.write(sensor);

      if(sensor <= 400) {
        Serial.println("wet");
        digitalWrite(pump, HIGH);
      }
      else {
        Serial.println("dry");
        digitalWrite(pump, LOW);
        delay(1000);
      }
     }
   }
//  delay(3000);
}
