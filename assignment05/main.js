// first ajax request
let endpoint1 = "https://api.themoviedb.org/3/movie/now_playing?api_key=0ddc75a935815a084979efd242ee3fee&language=en-US&page=1" 
console.log(endpoint1)
ajax(endpoint1, displayResult)

function ajax(endpoint, returnFunction) {
    let httpRequest = new XMLHttpRequest

    httpRequest.open("GET", endpoint)
    httpRequest.send()

    // event handler so that when TMDB does respond, run code
    httpRequest.onreadystatechange = function() {
        console.log(httpRequest.readyState)

        // got a full response from TMDB
        if (httpRequest.readyState == 4) {

            // Success
            if (httpRequest.status == 200) {
                console.log(httpRequest.responseText)
                returnFunction(httpRequest.responseText)
            } else {
                console.log("Error!")
                console.log(httpRequest.status)
            }
        }
    }
}

function displayResult(results) {
    console.log("displayresult called")

    // clear the previous result
    let moviesId = document.querySelector("#movies")
    //console.log(moviesId.hasChildNodes())
    while (moviesId.hasChildNodes()) {
        moviesId.removeChild(moviesId.lastChild)
    }

    // convert result into a JS object
    let convertedResults = JSON.parse(results)

    // number of movies returned in results
    let numMovies = convertedResults.results.length
    console.log(numMovies)

    // total number of search results
    let totalResults = convertedResults.total_results
    console.log(totalResults)

    // update number of results shown vs returned
    document.querySelector("#num-results").innerHTML = numMovies
    document.querySelector("#num-totalresults").innerHTML = totalResults

    // if results is a blank array
    if (convertedResults.total_results == 0) {
        let displayMessage = document.createElement("p")
        displayMessage.innerHTML = "No Result."

        let moviesDiv = document.querySelector(".container")
        moviesDiv.appendChild(displayMessage)

    } else {

        // create the movie cards and append it to the document
        for (let i = 0; i < numMovies; i++) {
            // create the overall div
            let overallDiv = document.createElement("div")
            overallDiv.classList.add("col-6")
            overallDiv.classList.add("col-md-4")
            overallDiv.classList.add("col-lg-3")
            overallDiv.classList.add("my-2")

            // create the card div
            let cardDiv = document.createElement("div")
            cardDiv.classList.add("card")
            cardDiv.style.width = "12rem"
            // ADD CARDDIV TO OVERALLDIV
            overallDiv.appendChild(cardDiv)

            // create the item div
            let itemDiv = document.createElement("div")
            itemDiv.classList.add("item")
            // ADD ITEMDIV TO CARDDIV
            cardDiv.appendChild(itemDiv)

            // create the img 
            let posterImg = document.createElement("img")
            posterImg.classList.add("card-img-top")
            let srcString = "http://image.tmdb.org/t/p/w185"
            let imgPath = convertedResults.results[i].poster_path
            if (imgPath != null) {
                srcString = "http://image.tmdb.org/t/p/w185" + convertedResults.results[i].poster_path
                posterImg.src = srcString
                posterImg.alt = convertedResults.results[i].title
            } else {
                posterImg.src = "images/imagenotfound.png"
                posterImg.alt = convertedResults.results[i].title
            }
            // ADD POSTERIMG TO ITEMDIV
            itemDiv.appendChild(posterImg)

            // create overlay div
            let overlayDiv = document.createElement("div")
            overlayDiv.classList.add("overlay")
            // ADD OVERLAYDIV TO ITEMDIV
            itemDiv.appendChild(overlayDiv)

            // create rating p tag
            let ratingP = document.createElement("p")
            ratingP.classList.add("text-center")
            // get the rating from the JSON file
            let ratingNum = convertedResults.results[i].vote_average
            ratingP.innerHTML = "Rating: " + ratingNum
            // ADD rating p tag to overlaydiv
            overlayDiv.appendChild(ratingP)

            // create number of voters p tag
            let numVotersP = document.createElement("p")
            numVotersP.classList.add("text-center")
            let numVoters = convertedResults.results[i].vote_count
            numVotersP.innerHTML = "Number of Voters: " + numVoters
            overlayDiv.appendChild(numVotersP)

            // create sypnosis p tag
            let sypnosisP = document.createElement("p")
            sypnosisP.classList.add("text-center")
            let sypnosis = convertedResults.results[i].overview
            if (sypnosis.length > 200) {
                sypnosis = sypnosis.substring(0, 200)
                sypnosis += "..."
            }
            sypnosisP.innerHTML = sypnosis
            overlayDiv.appendChild(sypnosisP)

        

            // create the cardbody div
            let cardBodyDiv = document.createElement("div")
            cardBodyDiv.classList.add("card-body")
            // ADD CARDBODYDIV TO CARDDIV
            cardDiv.appendChild(cardBodyDiv)

            // create p tag for movie title
            let titleP = document.createElement("p")
            titleP.classList.add("card-text")
            titleP.classList.add("text-center")
            titleP.innerHTML = convertedResults.results[i].title
            cardBodyDiv.appendChild(titleP)

            let dateP = document.createElement("p")
            dateP.classList.add("card-text")
            dateP.classList.add("text-center")
            dateP.innerHTML = convertedResults.results[i].release_date
            cardBodyDiv.appendChild(dateP)

            let moviesDiv = document.querySelector("#movies")
            moviesDiv.appendChild(overallDiv)
        }
    } 

}

// when the user either enters or clicks the submit button
document.querySelector("#search-form").onsubmit = function(event) {
    // prevent the page from refreshing automatically
    event.preventDefault()

    //console.log("Submitted!")

    // store the user input
    let searchInput = document.querySelector("#search-id").value.trim()
    //console.log(searchInput)

    // call the ajax function
    let endpoint = "https://api.themoviedb.org/3/search/movie?api_key=0ddc75a935815a084979efd242ee3fee&language=en-US&query=" + searchInput + "&page=1&include_adult=false"
    console.log(endpoint)
    ajax(endpoint, displayResult)
}