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
                <th scope="col">Posted Date</th>
                <th scope="col">Updated Date</th>
              </tr>
            </thead>
            <tbody>
`

const lastPart = `
</tbody>
</table>
<style>#disabled:hover{color:red}</style>

`





function fetchData() {
  $.ajax({
    url:  "../database/opinions.php",
    type: "GET",
    dataType: "json",
    data: {
      itemId: itemId
    },
    success: function(response) {
      // Update the HTML with the fetched data
      showOpinion(response);
    },
    error: function(xhr, status, error) {
      // Handle errors here
      console.log("First Error: " + error);
    }
  });
}

fetchData();

var intervalID = setInterval(fetchData, 1000);

const showOpinion = async (opinions) => {
  opinionList_html = firstPart;

  const promises = [];
  for(let i = 0; i <opinions.length; i++) {
    const {id, review, rating, userId, itemId, created_at, updated_at} = opinions[i];
    
    const promise = await $.ajax({
      url:  "../database/users.php",
      type: "GET",
      dataType: "json",
      data: {
          id: userId,
          forOpinions: 1,
      },
      success: function(response) {
        // Update the HTML with the fetched data

        opinionList_html = opinionList_html.concat(`
          <tr id="${id}" data-userId="${userId}">
              <th scope="row">${i+1}</th>
              <td>${response.username}</td>
              <td>${rating}</td>
              ${response.status==1 && user_id == userId || user_id == 1? `<td><a href="./opinion.php?id=${id}">${review}</a></td>`:
              `<td><a id=${response.status == 0 &&  user_id == userId ?"disabled":"abled"} >${review}</a></td>
              `
            }
            <td>${created_at}</td>
            <td>${updated_at}</td>

              
          </tr>
        `);

    
      },
      error: function(xhr, status, error) {
          // Handle errors here
          console.log("Error: " + error);
      }
    });

    promises.push(promise);
    //그냥 promise를 배열에 담으면 promise.all의 then 안에 있는 것만
    //promise 다음 순서로 시작함 나머지들은 비동기적으로 실행됨.
    //그래서 다음 next loop가 먼저 시작해서 promise 배열안에 순서가 뒤죽박죽됨.
  }

  Promise.all(promises).then(reponses => {
    opinionList_html = opinionList_html.concat(lastPart);
    $('#opinionList').html(
      opinionList_html
    )
  } )

  
}
    

console.log(user_id);

const findUsername = function(userId) {
  return new Promise(function(resolve, reject) {
    $.ajax({
      url: "../database/users.php",
      type: "GET",
      dataType: "json",
      data: {
        id: userId
      },
      success: function(response) {
        // Resolve the Promise with the fetched data
      },
      error: function(xhr, status, error) {
        // Reject the Promise with the error
        reject(error);
      }
    });
  });
};