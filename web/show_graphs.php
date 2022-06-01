<!DOCTYPE html>
<html>
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial;
  background: linear-gradient(#e66465, #9198e5);
}

.header {
  text-align: center;
  padding: 150px;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
}

.column iframe {
  margin-top: -88px;
  margin-bottom: 100px;
  vertical-align: middle;
  width: 100%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    -ms-flex: 50%;
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    -ms-flex: 100%;
    flex: 100%;
    max-width: 100%;
  }
}
</style>
<body>

<!-- Header -->
<div class="header">
  <h1>Mahindra University Weather Station</h1>
  <p>This is historic data of the weather @ Mahindra University.</p>
</div>

<!-- Photo Grid -->
<div class="row"> 
  <div class="column">
    <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1755530/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Temperature&type=line"></iframe>
    

   
  </div>
  <div class="column">
  <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1755530/charts/4?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Rain+History&type=step"></iframe>
    <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1755530/widgets/475096"></iframe>

  </div>  
  <div class="column">
  <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1755530/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Gas+Level+Percentage+%25&type=line"></iframe>
    <iframe width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1755530/widgets/475145"></iframe>



  </div>
  <div class="column">
  
    <iframe  width="450" height="260" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/1755530/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Humidity+Index&type=line"></iframe>


  </div>
</div>

</body>
</html>
