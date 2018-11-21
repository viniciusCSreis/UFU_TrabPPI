function submitLogin()
{
  let email = document.getElementById('email').value;
  let password = document.getElementById('password').value;

  let ajax = new XMLHttpRequest();

  ajax.open("POST", window.urlApi.login, true);
  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


  ajax.onreadystatechange = () =>   {
    if(ajax.readyState === 4 && ajax.status === 200)
    {
      window.location.pathname = window.urlRestrito;
    }
    else{
        $("#mensagemErro").show();
    }
  }
  ajax.send(`email=${email}&password=${password}`);

}
