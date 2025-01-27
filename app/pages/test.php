<!DOCTYPE html>
<html>
<head>
  <title>music player</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
@font-face{
  src: url('assets/fonts/Lato-Regular.ttf');
  font-family: lato;

}

*{
  box-sizing: border-box;
  margin: 0px;
  padding: 0px;
  
}

body{
  margin: 0px;
  min-width: 350px;
  height: 100%;
  font-family: lato, sans-serif, tahoma;
  padding: 0px;

}

.main{
  position: relative;
  min-height: 100vh;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #232427;
  border-radius: 8px;
  box-shadow: inset 5px 5px 5px rgba(0,0,0,0.2),
   inset -5px -5px 15px rgba(255,255,255,0.1),
   5px 5px 15px rgba(0,0,0,0.3),
   -5px -5px 15px rgba(255,255,255,0.1);
}
.main button{
  padding: 10px 12px;
  margin: 0 10px;
}
.main #logo{
  position: absolute;
  top: 10px;
  left: 30px;
  font-size: 25px;
  color: #ccc;
}
.main #logo i{
  margin-right: 15px;
}

/* left & right part */
.left{
  width: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

/* song image */
.left img{
  height: 300px;
  width: 80%;
  border-radius: 15px;
  object-fit: cover;
  box-shadow: inset 5px 5px 5px rgba(0,0,0,0.2),
   inset -5px -5px 15px rgba(255,255,255,0.1),
   5px 5px 15px rgba(0,0,0,0.3),
   -5px -5px 15px rgba(255,255,255,0.1);
   padding: 5px;
}

/* both range slider part */
input[type="range"] {
  -webkit-appearance: none;
  width: 50%;
  outline: none;
  height: 10px;
  margin: 0 15px;
  overflow: hidden;
  border-radius: 10px;
}
input[type="range"]::-webkit-slider-thumb{
  -webkit-appearance: none;
  height: 10px;
  width: 10px;
  background: #148F77;
  cursor: pointer;
  box-shadow: -415px 0 0 400px #148F77;
}
.right input[type=range]{
  width: 40%;
}

/* volume part */
.left .volume{
  margin-top: 25px;
  width: 80%;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
/*  border: 1px solid #fff;*/
}
.volume input[type="range"] {
  flex: 1;
}
.left .volume p{
  font-weight: bold;
  font-size: 15px;
}
.left .volume i{
  cursor: pointer;
  padding: 8px 12px;
  background: #148F77;
}
.left .volume i:hover{
  background: rgba(245,245,245,0.1);
}
.volume #volume_show{
  padding: 8px 12px;
  margin: 0 5px 0 0;
  background: rgba(245,245,245,0.1);
}

/* right part */
.right{
  width: 50%;
  padding: 10px 0;
  display: flex;
  align-items: center;
  flex-direction: column;
}
 .right .middle{
  width: 100%;
    display: flex;
  align-items: center;
  justify-content: center;
}
.right .middle button{
  border: none;
  height: 70px;
  width: 70px;
  border-radius: 50%; 
    display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  outline: none;
  transition: 0.5s;
  background: #232427;
  box-shadow: inset 5px 5px 5px rgba(0,0,0,0.2),
   inset -5px -5px 15px rgba(255,255,255,0.1),
   5px 5px 15px rgba(0,0,0,0.3),
   -5px -5px 10px rgba(255,255,255,0.1);
}
.song_detail{
  position: relative;
  width: 80%;
  overflow: hidden;
  margin-bottom: 6.5em;
/*  border: 1px solid #fff;*/
}
.song_detail #title{
  text-transform: capitalize;
  color: #fff;
  font-size: 35px;
}
.song_detail #artist{
  text-transform: capitalize;
  color: #fff;
  font-size: 18px;
  margin-top: 5px;
}
.right .duration{
  margin-top: 3em;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 80%;
/*  border: 1px solid #fff;*/
}
.duration input[type="range"] {
  flex: 1;
}
.right #auto{
  font-size: 15px;
  text-align: center;
  cursor: pointer;
  border: none;
  padding: 5px 7px;
  color: #fff;
  background: rgba(255,255,255,0.2);
  outline: none;
  border-radius: 10px;
  box-shadow: inset 2px 2px 5px rgba(0,0,0,0.2),
   inset -2px -2px 5px rgba(255,255,255,0.1),
   5px 5px 15px rgba(0,0,0,0.3),
   -5px -5px 15px rgba(255,255,255,0.1);
}
#play{
  background: #148F77;
}
.right button:hover{
  background: #148F77;
}
.right i:before{
  color: #fff;
  font-size: 20px;
}
.show_song_no{
  position: absolute;
  top: 10px;
  right: 10px;
  width: 30px;
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 8px 12px;
  color: #fff;
  border-radius: 5px;
  background: rgba(255,255,255,0.2);
  box-shadow: inset 2px 2px 5px rgba(0,0,0,0.2),
   inset -2px -2px 5px rgba(255,255,255,0.1),
   5px 5px 15px rgba(0,0,0,0.3),
   -5px -5px 15px rgba(255,255,255,0.1);

}
.show_song_no p:nth-child(2){
  margin: 0 5px;
}

/*responsive*/
@media(max-width: 700px){
  .main{
    min-height: 100vh;
    width: 100%;
    flex-direction: column;
  }
  .right{
    margin-top: 50px;
    width: 60%;
  }
  .right .duration{
        width: 90%;
  }
  .left{
    margin-top: 5em;
      width: 60%;
  }
  .left img{
        min-width: 90%;
        height: 180px;
  }
  .main #logo{
    display: none;
  }
  .song_detail{
    position: absolute;
    top: 5px;
    left: 10px;
    width: 80%;
    height: 70px;
  }
  .song_detail #title{
    font-size: 1.8em;
  }
}

@media(max-width: 500px){
  .main{
    min-height: 100vh;
    width: 100%;
    flex-direction: column;
  }
  .right{
    margin-top: 50px;
    width: 80%;
  }
  .left{
    margin-top: 5em;
      width: 80%;
  }
  .left img{
        min-width: 90%;
        height: 180px;
  }
  .main #logo{
    display: none;
  }
  .song_detail{
    position: absolute;
    top: 5px;
    left: 10px;
    width: 80%;
    height: 70px;
  }
  .song_detail #title{
    font-size: 1.5em;
  }
  .song_detail #artist{
    font-size: 0.8em;
  }
  .right .middle button{
    height: 62px;
      width: 62px;
  }
}
    </style>
</head>

<body>


<?php
$rows = db_query("select * from songs order by date desc limit 8");
// Kiểm tra xem truy vấn đã thành công hay không
if ($rows !== false && is_array($rows)) {
    $count = count($rows); // Lấy số lượng hàng trả về
} else {
    $count = 0; // Nếu truy vấn không thành công hoặc không có hàng nào được trả về
}
$songs = [];

// Kiểm tra xem có dữ liệu trả về hay không
if ($rows !== false && is_array($rows)) {
    // Khởi tạo mảng mới để lưu trữ dữ liệu theo cấu trúc mong muốn

    // Lặp qua các hàng trong mảng $rows
    foreach ($rows as $row) {
        // Tạo một mảng mới chứa thông tin của mỗi bài hát
        $song = [
            'id' => $row['id'],
            'title' => $row['title'],
            'image' => $row['image'],
            'category' => get_category($row['category_id']),
            'artist' => get_artist($row['artist_id']),
            'file' => $row['file']
        ];

        // Thêm mảng của bài hát vào mảng songs
        $songs[] = $song;
    }

} else {
    // Xử lý trường hợp không có dữ liệu trả về
    echo "No songs found.";
}


$myJSON = json_encode($songs);

$myfile = fopen("json_pagination.txt", "w") or die("Unable to open file!");
fwrite($myfile, $myJSON);

fclose($myfile);
?>





         <div class="main">
      <p id="logo"><i class="fa fa-music"></i>Music</p>
      
          <!-- show_song_number -->
          <div class="show_song_no">
            <p id="present">1</p>
            <p>/</p>
            <p id="total"><?=$count?></p>
          </div>


      <!--- left part --->
       <div class="left">

        <!--- song img --->
        <img id="track_image">
           <div class="volume">
              <p id="volume_show">90</p>
              <i class="fa fa-volume-up" aria-hidden="true" onclick="mute_sound()" id="volume_icon"></i>
              <input type="range" min="0" max="100" value="90" onchange="volume_change()" id="volume">  
           </div>

       </div>
   
       <!--- right part --->
       <div class="right">
         <!--- song title & artist name --->
         <div class="song_detail">
             <p id="title">title.mp3</p>
             <p id="artist">Artist name</p>
         </div>

        <!--- middle part --->
        <div class="middle">
             <button onclick="previous_song()" id="pre"><i class="fa fa-step-backward" aria-hidden="true"></i></button>
             <button onclick="justplay()" id="play"><i class="fa fa-play" aria-hidden="true"></i></button>
             <button onclick="next_song()" id="next"><i class="fa fa-step-forward" aria-hidden="true"></i></button>
         </div>

         <!--- song duration part --->
          <div class="duration">
             <input type="range" min="0" max="100" value="0" id="duration_slider" onchange="change_duration()">
             <button id="auto" onclick="autoplay_switch()">Auto &nbsp;<i class="fa fa-circle-o-notch" aria-hidden="true"></i></button>
          </div>
             
      </div>


    </div> 



   
  <!--- Add javascript file --->
  <script>
    let previous = document.querySelector('#pre');
let play = document.querySelector('#play');
let next = document.querySelector('#next');
let title = document.querySelector('#title');
let recent_volume= document.querySelector('#volume');
let volume_show = document.querySelector('#volume_show');
let slider = document.querySelector('#duration_slider');
let show_duration = document.querySelector('#show_duration');
let track_image = document.querySelector('#track_image');
let auto_play = document.querySelector('#auto');
let present = document.querySelector('#present');
let total = document.querySelector('#total');
let artist = document.querySelector('#artist');



let timer;
let autoplay = 0;

let index_no = 0;
let Playing_song = false;

//create a audio Element
let track = document.createElement('audio');

let All_song = [];
//All songs list
const xmlhttp = new XMLHttpRequest();
xmlhttp.onload = function() {
    console.log(this.responseText);
    const myObj = JSON.parse(this.responseText);
    myObj.forEach(function(songData) {
    let song = {
        name: songData.title,
        path: songData.file,
        img: songData.image,
        singer: songData.artist,
    };
    All_song.push(song);
});
    
}
xmlhttp.open("GET", "json.txt");
xmlhttp.send();



// function load the track
function load_track(index_no){
  clearInterval(timer);
  reset_slider();

  track.src = All_song[index_no].path;
  title.innerHTML = All_song[index_no].name;  
  track_image.src = All_song[index_no].img;
    artist.innerHTML = All_song[index_no].singer;
    track.load();

  timer = setInterval(range_slider ,1000);
  total.innerHTML = All_song.length;
  present.innerHTML = index_no + 1;
}

load_track(index_no);


//mute sound function
function mute_sound(){
  track.volume = 0;
  volume.value = 0;
  volume_show.innerHTML = 0;
}


// checking.. the song is playing or not
 function justplay(){
  if(Playing_song==false){
    playsong();

  }else{
    pausesong();
  }
 }


// reset song slider
 function reset_slider(){
  slider.value = 0;
 }

// play song
function playsong(){
  track.play();
  Playing_song = true;
  play.innerHTML = '<i class="fa fa-pause" aria-hidden="true"></i>';
}

//pause song
function pausesong(){
  track.pause();
  Playing_song = false;
  play.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
}


// next song
function next_song(){
  if(index_no < All_song.length - 1){
    index_no += 1;
    load_track(index_no);
    playsong();
  }else{
    index_no = 0;
    load_track(index_no);
    playsong();

  }
}


// previous song
function previous_song(){
  if(index_no > 0){
    index_no -= 1;
    load_track(index_no);
    playsong();

  }else{
    index_no = All_song.length;
    load_track(index_no);
    playsong();
  }
}


// change volume
function volume_change(){
  volume_show.innerHTML = recent_volume.value;
  track.volume = recent_volume.value / 100;
}

// change slider position 
function change_duration(){
  slider_position = track.duration * (slider.value / 100);
  track.currentTime = slider_position;
}

// autoplay function
function autoplay_switch(){
  if (autoplay==1){
       autoplay = 0;
       auto_play.style.background = "rgba(255,255,255,0.2)";
  }else{
       autoplay = 1;
       auto_play.style.background = "#148F77";
  }
}


function range_slider(){
  let position = 0;
        
        // update slider position
    if(!isNaN(track.duration)){
       position = track.currentTime * (100 / track.duration);
       slider.value =  position;
        }

       
       // function will run when the song is over
       if(track.ended){
         play.innerHTML = '<i class="fa fa-play" aria-hidden="true"></i>';
           if(autoplay==1){
           index_no += 1;
           load_track(index_no);
           playsong();
           }
      }
     }
  </script>

</body>
</html>


