<div class="start">
  <input onclick="openWindow()" id="start" type="image" src="images/folder.png" alt="icon folder">
  <p class="p_start">START</p>

</div>



<div class="bar_outils">

  <img class="logo_acs" src="images/logo-acs.png" alt="logo access code school">
  <div class="acs"><img class="icon_diplome" src="images/mortarboard.png" alt="icone diplome"><p class="p_acs">Access Code School</p></div>
  <img class="logo_php_js" src="images/php.png" alt="logo php">
  <img class="logo_php_js" src="images/javascript.png" alt="logo javascript">

  <div class="julie_laurine">
    <img class="icon_woman" src="images/people.png" alt="icon woman"><p>Julie BOULENGER</p>
    <img class="icon_woman icon_laurine" src="images/woman.png" alt="icon woman"><p>Laurine HERARD</p>
  </div>

  <div class="today">
    <div class="time"><?php date_default_timezone_set("Europe/Paris"); echo date("H:i")?></div>
    <div class="date"><?php echo date("d/m/Y")?></div>
  </div>

</div>


.bar_outils {
  background-color: #A23B45;
  width: 100%;
  height: 35px;
  position: fixed;
  bottom: 0;
  margin-left: -8px;
  display: flex;
}
.bar_outils img{
  width: 35px;
}
.acs{
  font-size: 1rem;
  display: flex;
  align-items: center;
  margin-left: 0.4rem;
  margin-right: 2rem;
  margin-top: 0;
  padding-left: 1rem;
  padding-right: 8.9rem;
  background-color: white;
  height: 36px;
}
.p_acs{
  padding-left: 1em;
}
.icon_diplome{
  width: 25px!important;
}
.logo_acs{
  margin-left: 0.4rem;
}
.logo_php_js{
  margin-right: 2rem;
}
.date{
  display: flex;
}
.time{
  display: flex;
  justify-content: center;
}
.today{
  display: block;
  align-items: center;
  font-size: 0.8rem;
  margin-left: 33rem;
  color: white;
}
.julie_laurine{
  display: flex;
  align-items: center;
  font-size: 0.9rem;
  margin-left: 2rem;
  color: white;
}
.icon_woman{
  width: 32px!important;
  height: 32px;
  margin-right: 0.8rem;
}
.icon_laurine{
  margin-left: 2rem;
}
.start{
  position: absolute;
  top: 20vh;
  right: 10vh;
}
.p_start{
  color: white;
  margin-top: 0;
}
.start input{
  width: 60px;
}


function closeWindow() {
  document.getElementById('close').style.display = "none";

}
function openWindow() {
  document.getElementById('close').style.display = "block";
}
