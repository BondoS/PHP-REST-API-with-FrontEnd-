const http = new XMLHttpRequest();
const url = 'http://localhost/projects/proj/FinalProject/api/song/all.php';
http.open("GET", url);
http.send();
const id = parse_query_string(window.location.search.slice(1)).id;
const urlWithoutMediaQuery = window.location.pathname.split('?')[0].split('/');
const lastItemUrl = urlWithoutMediaQuery[window.location.pathname.split('/').length - 1];
const beforeLastItemUrl = urlWithoutMediaQuery[window.location.pathname.split('/').length - 2];

$(document).ready((e) => {

    // debugger;
    //DOM
    // Edit track
    if (typeof lastItemUrl !== "undefined" && typeof parseInt(lastItemUrl) !== Number &&
        typeof beforeLastItemUrl !== "undefined" && beforeLastItemUrl === "edit.php") {
        $.ajax({
            type: 'GET',
            url: 'http://localhost/projects/proj/FinalProject/api/Song/song.php?id=' + lastItemUrl,
            dataType: 'json',
            success: function (data) {
                console.log('data', data);
                Object.keys(data).map(function (key, index) {
                    $('#' + key).val(data[key]);
                });

            }
        });
        $("form").submit(function (event) {
            event.preventDefault();
            var track =
            {
                "name": $('#name').val(),
                "artist": $('#artist').val(),
                "gener": $('#gener').val(),
                "youtubeLink": $('#youtubeLink').val(),
                "id": lastItemUrl,
            };

            $.ajax({
                type: "POST",
                url: "http://localhost/projects/proj/FinalProject/api/song/update.php",
                // The key needs to match your method's input parameter (case-sensitive).
                data: JSON.stringify({ track }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data) {
                    $('form').find("input[type=text], textarea").val("");
                    alert('Track updated successfully');
                    setTimeout(() => {
                        window.location.replace(domain);
                    }, 500);
                },
                failure: function (errMsg) {
                    console.log(errMsg);
                }
            });
        });


    } else if (typeof lastItemUrl !== "undefined" && lastItemUrl === "new.php" &&
        typeof beforeLastItemUrl !== "undefined" && beforeLastItemUrl === "track") {
        // Add New track
        $("form").submit(function (event) {
            event.preventDefault();
            var track =
            {
                "name": $('#name').val(),
                "artist": $('#artist').val(),
                "gener": $('#gener').val(),
                "youtubeLink": $('#youtubeLink').val()
            };

            $.ajax({
                type: "POST",
                url: "http://localhost/projects/proj/FinalProject/api/song/create.php",
                // The key needs to match your method's input parameter (case-sensitive).
                data: JSON.stringify({ track }),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data) {
                    $('form').find("input[type=text], textarea").val("");
                    alert('New track created successfully');
                    setTimeout(() => {
                        window.location.replace(domain);
                    }, 500);
                },
                failure: function (errMsg) {
                    console.log(errMsg);
                }
            });
        });
    } else {
        const jsonData = JSON.parse(http.responseText);
        for (let i = 0; i < jsonData.songs.length; i++) {
            let song = jsonData.songs[i];
            addItem(i, song.id, song.name, song.artist, song.gener, song.youtubeLink)
        }
        function addItem(listItemId, id, name, artist, gener, youtubeLink) {
            let ul = document.getElementById("dynamic-list");
            let li = document.createElement("li");
            li.style.color = "#FFFFFF";
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
            let aTag = document.createElement("a");
            aTag.href = domain + "/track/edit.php/" + id;
            aTag.innerHTML = "Edit"
            $(aTag).addClass('btn btn-primary').attr('type', 'button');
            li.appendChild(aTag);
            let aTag2 = document.createElement("a");
            aTag2.innerHTML = "Delete"
            $(aTag2).addClass('btn btn-danger delete-track').attr('track-id', id);
            li.appendChild(aTag2);
            ul.appendChild(li);

        }

        $('.delete-track').click((e) => {
            console.log($(e.target).attr('track-id'));
            var result = confirm("Track will be deleted, Please Confirm");
            if (result) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost/projects/proj/FinalProject/api/song/delete.php",
                    // The key needs to match your method's input parameter (case-sensitive).
                    data: JSON.stringify({ 'id': $(e.target).attr('track-id') }),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function (data) {
                        alert('Track deleted successfully');
                        setTimeout(() => {
                            window.location.replace(domain);
                        }, 500);
                    },
                    failure: function (errMsg) {
                        console.log(errMsg);
                    }
                });
            }

        })
    }
});
function parse_query_string(query) {
    var vars = query.split("&");
    var query_string = {};
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        var key = decodeURIComponent(pair[0]);
        var value = decodeURIComponent(pair[1]);
        // If first entry with this name
        if (typeof query_string[key] === "undefined") {
            query_string[key] = decodeURIComponent(value);
            // If second entry with this name
        } else if (typeof query_string[key] === "string") {
            var arr = [query_string[key], decodeURIComponent(value)];
            query_string[key] = arr;
            // If third or later entry with this name
        } else {
            query_string[key].push(decodeURIComponent(value));
        }
    }
    return query_string;
}