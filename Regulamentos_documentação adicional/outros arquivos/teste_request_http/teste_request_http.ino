#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "RDR_conection_test";
const char* password = "123qwe++";
 
WiFiServer server(80);
 
String url = "";
bool httpFunction = false;
void setup() {
  Serial.begin(115200);
  delay(10);
  // Connect to WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi connected");
  // Start the server
  server.begin();
  Serial.println("Server started");
  // Print the IP address
  Serial.print("Use this URL to connect: ");
  Serial.print("http://");
  Serial.print(WiFi.localIP());
  Serial.println("/");
}
void loop() {
  float temp = 100;
  delay(1000);
   Serial.println(temp);
    url="http://192.168.1.7/t?temp="+String(temp);
    httpConnect(url);
}
      bool httpConnect(String url) {
    HTTPClient http;  // Declare an object of class HTTPClient
    http.begin(url);  // Specify request destination
    int httpCode = http.GET(); //Send the request
    if (httpCode > 0) { // Check the returning code
      String payload = http.getString();   //Get the request response payload
    }
    http.end();   // Close connection
    return true;
}
