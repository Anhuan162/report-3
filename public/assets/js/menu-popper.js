


var links = document.querySelector("header").querySelectorAll(".nav-item");

for (var i = 0; i < links.length; i++) {
	if(links[i].children[0].href == window.location.href || links[i].children[0].href+"/" == window.location.href)
	{
		links[i].classList.add("active");
	}
}




// Choose content of right record

function showContent(contentId) {
	document.getElementById("content1").style.display = "none";
	document.getElementById("content2").style.display = "none";
	document.getElementById("content3").style.display = "none";
	document.getElementById(contentId).style.display = "block";
}


document.getElementById("top10_nhac-viet").addEventListener("click", function(event) {
    event.preventDefault();
    showContent("content1");
});

document.getElementById("top10_au-mi").addEventListener("click", function(event) {
    event.preventDefault();
    showContent("content2");
});

document.getElementById("top10_nhac-han").addEventListener("click", function(event) {
    event.preventDefault();
    showContent("content3");
});

window.onload = function() {
    showContent("content1");
};



//
function showPart(partId) {
	document.getElementById("part1").style.display = "none";
	document.getElementById("part2").style.display = "none";
	document.getElementById("part3").style.display = "none";
	document.getElementById(partId).style.display = "block";
}


document.getElementById("nhac-viet").addEventListener("click", function(event) {
    event.preventDefault();
    showPart("part1");
});

document.getElementById("nhac-au-mi").addEventListener("click", function(event) {
    event.preventDefault();
    showPart("part2");
});

document.getElementById("nhac-chau-a").addEventListener("click", function(event) {
    event.preventDefault();
    showPart("part3");
});

window.onload = function() {
    showPart("part1");
};




function playSong(file, img) {
	var audio = document.getElementById('audioPlayer');
	audio.src = file;
	var image = document.getElementById('imagePlayer');
	image.src = img
	audio.play();

	// Xóa lớp active của tất cả các thẻ li trước khi thêm lớp active cho thẻ li được chọn
	var listItems = document.querySelectorAll('.list-group-item');
	listItems.forEach(function(item) {
	    item.classList.remove('active');
	});

	// Thêm lớp active cho thẻ li được chọn
	event.target.closest('.list-group-item').classList.add('active');
}