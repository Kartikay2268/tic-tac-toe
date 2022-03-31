let utils = {};
let url = "checkStatus.php";
utils.get = (url) => {

  return new Promise (function(resolve, reject) {
    let req = new XMLHttpRequest();

    req.open('GET',url);

    req.onload = () => {
      if(req.status == 200) {
        console.log('response');
        resolve(req.response);
      }

      else{
        reject(Error('promise error with' + req.status));
      }
    };

    req.onerror = (err) => {
      reject(Error('Network Error with '+url+': ' + err));
    };
    req.send();
  });
};

utils.get(url).then( function (data){
  //console.log(data);
}).catch(function(e){
  console.log('Error - ' + e);
});

utils.getJSON = async function(url) {

  var string = null;
  try{
    string = await utils.get(url);
  }
  catch (e){
    console.log("error: " + e);
  }
  var data = JSON.parse(string);
  return data;
}

async function init() {
  let table = document.querySelector('#table-status');
  let url = "checkStatus.php";
  let status = await utils.getJSON(url);
  table.innerHTML = "";


  for (let key in status) {
    let newRow = table.insertRow(table.length);
    newRow.insertCell(0).innerHTML = key;
    newRow.insertCell(1).innerHTML = status[key];
  }
};
init();
setInterval(init, 10000);
