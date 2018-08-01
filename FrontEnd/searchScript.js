var data;
var request = new XMLHttpRequest();


function Search() {
  var searchTerms = document.getElementById("search").value;
  var budgetMax = document.getElementById("budget").value;
  var e = document.getElementById("rating");
  var rating = e.options[e.selectedIndex].value;
  var summaryTerms = document.getElementById("summary").value;
  console.log(searchTerms);
  console.log(budgetMax);
  console.log(rating);
  console.log(summaryTerms);
  
  //var search = 'http://localhost/class/movieAPI/search_results.php' + '?query=' + searchTerms;
  var search = 'http://localhost/BackEnd/search_results.php' + '?query=' + searchTerms;
  if (budgetMax != "") {

    search += '&budget=' + budgetMax;
  }
  if (rating != "") {
    search += '&rating=' + rating;
  }
  if (summaryTerms != "") {
    search += '&summary=' + summaryTerms;
  }

  console.log(search);
  request.open('GET', search);
  request.onload = loadComplete;
  request.send();
}

function loadComplete(evt) {
  data = JSON.parse(request.responseText);
  //data = request.responseText;
  Movies = data.Movies;
  document.getElementById("res").innerHTML = "Results:";
  var resultBox = document.getElementById("results");
  resultBox.innerHTML = "";
  console.log(Movies);
  if (Movies == undefined) {
    console.log("No Results");
    resultBox.innerHTML = "<h2>No Results, try narrowing your Search.</h2>";
  }
  else {
    for (var i = 0; i < Movies.length; i++) {
      var movie = Movies[i];
      var title = movie.Title;
      var release = movie.Release;
      var budget = movie.Budget;
      var length = movie.Length;
      var rating = movie.Rating;
      var tagline = movie.Tagline;
      var summary = movie.Summary;
      console.log(title);
      console.log(budget);
      console.log(length);
      console.log(rating);
      console.log(release);
      console.log(summary);
      console.log(tagline);

      resultBox.innerHTML += '<h1 id="title">' + title + '</h1>';
      resultBox.innerHTML += '<h3 id="tagline"><em>' + tagline + '</em></h3>';
      resultBox.innerHTML += '<p id="summary">Summary: ' + summary + '</p>';
      resultBox.innerHTML += '<h4 id="budget">Budget: ' + budget + ' Million dollars</h4>';
      resultBox.innerHTML += '<h4 id="length">Length: ' + length + ' Minutes</h4>';
      resultBox.innerHTML += '<h4 id="rating">Rating: ' + rating + '</h5>';
      resultBox.innerHTML += '<h4 id="release">Released: ' + release + '</h4>';
      resultBox.innerHTML += '<hr />';
      console.log(data);
    }
  }


}