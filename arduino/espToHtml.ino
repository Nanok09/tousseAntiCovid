#include <Wire.h>
#include "Adafruit_MMA8451.h"
#include <Adafruit_Sensor.h>
#include <WiFi.h>
#include <HTTPClient.h>

/**Wifi Data**/
const char* ssid = "Flortissimo pour la plèbe";
const char* password =  "bambou210";
/*************/

Adafruit_MMA8451 mma = Adafruit_MMA8451();
 
void setup(void) {
  Serial.begin(9600);

  /**Wifi setup**/

  delay(4000);   //Delay needed before calling the WiFi.begin
  
  WiFi.begin(ssid, password); 
  
  while (WiFi.status() != WL_CONNECTED) { //Check for the connection
    delay(1000);
    Serial.println("Connecting to WiFi..");
  }
  
  Serial.println("Connected to the WiFi network");

  /**Sensors setup**/
 
  //Serial.println("Adafruit MMA8451 test!");
 
 
  if (! mma.begin()) {
    Serial.println("Couldnt start");
    while (1);
  }
  Serial.println("MMA8451 found!");
 
  mma.setRange(MMA8451_RANGE_2_G);
 
  Serial.print("Range = "); Serial.print(2 << mma.getRange());  
  Serial.println("G");
 
}
 
void loop() {
  
  /* Get a new sensor event */ 
  sensors_event_t event;
  mma.getEvent(&event);
 
  /* Display the results (acceleration is measured in m/s^2) */
  Serial.print("X: \t"); Serial.print(event.acceleration.x); Serial.print("\t");
  Serial.print("Y: \t"); Serial.print(event.acceleration.y); Serial.print("\t");
  Serial.print("Z: \t"); Serial.print(event.acceleration.z); Serial.print("\t");
  Serial.println("m/s^2 ");
 
  Serial.println();


  /**Send data with HTTP request**/
   if(WiFi.status()== WL_CONNECTED){   //Check WiFi connection status
  
      HTTPClient http;   
  
      http.begin("http://192.168.0.104/serveur.php");  //Specify destination for HTTP request
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");             //Specify content-type header

      float accel = sqrt((event.acceleration.x)*(event.acceleration.x) + (event.acceleration.y)*(event.acceleration.y) + (event.acceleration.z)*(event.acceleration.z));
      String accelString = String(accel, 2);
      
      String httpMsg = "accel=" + accelString;
      
      int httpResponseCode = http.POST(httpMsg);   //Send the actual POST request
  
      if(httpResponseCode>0){
  
          String response = http.getString();                       //Get the response to the request
  
          Serial.println(httpResponseCode);   //Print return code
          Serial.println(response);           //Print request answer
  
      }else{
  
          Serial.print("Error on sending POST: ");
          Serial.println(httpResponseCode);
  
      }
  
      http.end();  //Free resources
  
   }else{
  
    Serial.println("Error in WiFi connection");   
  
   }
  
    delay(5000);
}
