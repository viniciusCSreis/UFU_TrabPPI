
function logout()
{
  let ajax = new XMLHttpRequest();

  ajax.open("POST", window.urlApi.logout, true);
  ajax.onreadystatechange = () => {
    if(ajax.readyState === 4 && ajax.status === 200)
    {
      window.location.pathname = window.urlIndex;
    }
  }
  ajax.send();
  
}