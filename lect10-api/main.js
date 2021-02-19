// function takes care of the display of music information
function displayResult(results) {
    // clear out the previous result
    let tbody = document.querySelector("tbody")
    // .hasChildNOdes() - returns true or false
    // .removeChild() removes childNodes
    // need to specify which child to remove
    while (tbody.hasChildNodes()) {
        tbody.removeChild(tbody.lastChild)
    }

    //console.log(results)

    // results are currently a STRING in Json format
    // convert this string into JS objects

    let convertedResults = JSON.parse(results)

    //console.log(convertedResults)
    //console.log(convertedResults.results[0].artistName)

    // for each result (5,10,15, etc) make a tr tag
    // iterate through all the results. 
    // create new elements per result
    for (let i = 0; i < convertedResults.results.length; i++) {
        // Create a <tr> tag
        let trTag = document.createElement("tr")

        // create a <td> tag for album art
        let coverTd = document.createElement("td")
        // create an <img> for the album art image
        let imgTag = document.createElement("img")
        imgTag.src = convertedResults.results[i].artworkUrl100
        // append the img to the td tag
        coverTd.appendChild(imgTag)

        // create a <td> tag for the artist
        let artistTd = document.createElement("td")
        artistTd.innerHTML = convertedResults.results[i].artistName
        
        // create a <td> tag for the track
        let trackTd = document.createElement("td")
        trackTd.innerHTML = convertedResults.results[i].trackName

        // create a <td> tag for the album
        let albumTd = document.createElement("td")
        albumTd.innerHTML = convertedResults.results[i].collectionName

        // create a <td> tag for the music preview
        let audioTd = document.createElement("td")
        let audioTag = document.createElement("audio")
        audioTag.src = convertedResults.results[i].previewUrl
        audioTag.controls = true
        audioTd.appendChild(audioTag)

        // append all the td tags to the tr tag
        trTag.appendChild(coverTd)
        trTag.appendChild(artistTd)
        trTag.appendChild(trackTd)
        trTag.appendChild(albumTd)
        trTag.appendChild(audioTd)

        //console.log(trTag)

        // append the tr tag to the HTML body
        // append the <tr> tag to the <tbody> to make it show up on the browswer!
        let tbody = document.querySelector("tbody")
        tbody.appendChild(trTag)
    }

}

// separate function for AJAX
// first param is endpoint
// second param is the name of function
function ajax(endpoint, returnFunction) {
    let httpRequest = new XMLHttpRequest()
    
    // .open() opens a new http request
    // 2 parameters: 1) METHOD, 2) endpoint
    httpRequest.open("GET", endpoint)

    // .send() sends the request to the specified endpoint
    httpRequest.send();

    // create an event handler so that when iTunes does respond, 
    // we make it run some code
    httpRequest.onreadystatechange = function() {
        console.log(httpRequest.readyState)

        // readyState == 4 when we have a full response from iTunes
        if(httpRequest.readyState == 4) {

            // Check if we got a success or error response from iTunes
            if (httpRequest.status == 200) {
                // 200 means success! we got something back
                // .responseText will give us whatever iTunes sent back to us as a String
                //console.log(httpRequest.responseText)

                // passing the result data to the displayResult function
                returnFunction(httpRequest.responseText)
            } else {
                console.log("Error!")
                console.log(httpRequest.status)
            }

        }
        
    }
}
// When user submits the search form
// onsubmit Event handler picks up both mouse clicking the submit button
// and also the enter key 
document.querySelector("#search-form").onsubmit = function(event) {
    // prevent page refresh and the form submitting
    event.preventDefault();

    //console.log("submitted!")

    // store whatever the user typed in
    let searchInput = document.querySelector("#search-id").value.trim()
    
    let limitInput = document.querySelector("#limit-id").value

    console.log(searchInput)
    console.log(limitInput)

    // call the ajax function
    let endpoint = "https://itunes.apple.com/search?term=" + searchInput + "&limit=" + limitInput
    ajax(endpoint, displayResult)

}