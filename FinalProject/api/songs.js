const http = new XMLHttpRequest();
const url = 'http://localhost:63342/FinalProject/api/song/all.php';
http.open("GET", url);
http.send();
http.onreadystatechange = (e) => {

    const jsonData = JSON.parse(http.responseText);
    for (let i = 0; i < jsonData.songs.length; i++) {
        let song = jsonData.songs[i];
        addItem(i, song.name, song.artist, song.gener, song.youtubeLink)

    }
//DOM
    function addItem(listItemId, name, artist, gener, youtubeLink) {
        let ul = document.getElementById("dynamic-list");
        let li = document.createElement("li");
        li.style.color = "#000000";
        let h1 = document.createElement("h1");
        h1.innerHTML = name
        li.appendChild(h1);
        let h2 = document.createElement("h3");
        h2.innerHTML = artist;
        li.appendChild(h2);
        let h3 = document.createElement("h4");
        h3.innerHTML = gener;
        li.appendChild(h3);
        let iFrame = document.createElement("iframe");
        iFrame.width = "560";
        iFrame.height = "315";
        iFrame.allow = "autoplay";
        iFrame.src = "http://www.youtube.com/embed/" + youtubeLink;
        li.appendChild(iFrame);
        li.setAttribute('id', listItemId);
        ul.appendChild(li);
    }
}
