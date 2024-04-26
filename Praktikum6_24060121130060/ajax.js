// Nama : Laily Novita Sari
// NIM  : 24060121130056
// Lab  : A1 PBP

function getXMLHttpRequest() {
  if (window.XMLHttpRequest) {
    //code for modern browser
    return new XMLHttpRequest();
  } else {
    //code for old IE browser
    return new ActiveXObject("Microsoft.XMLHTTP");
  }
}


function getUser() {
  var email = encodeURI(document.forms["daftar"]["email"].value);
  var inner = "error_email";
  var url = "get_user.php?email=" + email;

  //TODO 8 : write ajax request to url
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", url, true);
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (xmlhttp.responseText == "tersedia") {
        document.getElementById(inner).innerHTML = "Email tersedia";
        document.getElementById(inner).style.color = "green";
      } else {
        document.getElementById(inner).innerHTML = "";
      }
    }
  };
  xmlhttp.send();
}

function getKabupaten(kode_prov) {
  var inner = "kabupaten";
  var url = "get_kabupaten.php?kode_prov=" + kode_prov;

  //TODO 9 : write ajax request to url
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", url, true);
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById(inner).innerHTML = xmlhttp.responseText;
    }
  };
  xmlhttp.send();
}


