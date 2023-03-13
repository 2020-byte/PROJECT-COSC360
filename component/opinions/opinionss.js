let opinionList_html;

const firstPart = `
<table class="table table-striped">
            <style>
                .table a {
                    text-decoration: none;
                    color: black;
                }
                .table a:hover {
                    color: blue;
                }
            </style>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Rating</th>
                <th scope="col">Review</th>
              </tr>
            </thead>
            <tbody>
`

const lastPart = `
</tbody>
</table>
`





$.ajax({
  url:  "../database/opinions.php",
  type: "GET",
  dataType: "json",
  data: {
      id: itemId
  },
  success: function(response) {
    // Update the HTML with the fetched data
    showOpinion(response);

    

  },
  error: function(xhr, status, error) {
      // Handle errors here
      console.log("Error: " + error);
  }
});

const showOpinion = (opinions) => {
  opinionList_html = firstPart;

  const promises = [];
  for(let i = 0; i <opinions.length; i++) {
    const {id, review, rating, userId, itemId} = opinions[i];
    
    const promise = $.ajax({
      url:  "../database/users.php",
      type: "GET",
      dataType: "json",
      data: {
          id: userId
      },
      success: function(response) {
        // Update the HTML with the fetched data
        
        opinionList_html = opinionList_html.concat(`
          <tr id="${id}" data-userId="${userId}">
              <th scope="row">${i+1}</th>
              <td>${response.username}</td>
              <td>${rating}</td>
              <td><a href="./opinion.php?id=${id}">${review}</a></td>
          </tr>
        `);
    
      },
      error: function(xhr, status, error) {
          // Handle errors here
          console.log("Error: " + error);
      }
    });

    promises.push(promise);
  }

  Promise.all(promises).then(reponses => {
    opinionList_html = opinionList_html.concat(lastPart);
    console.log(opinionList_html);
    $('#opinionList').html(
      opinionList_html
    )
  } )

  
}
    
