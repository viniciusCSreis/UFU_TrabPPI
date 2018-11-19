class NavBar
{
    constructor(elemento)
    {
        this._elemento = elemento;
    }
    create()
    {
        this._elemento.innerHTML =
        `
        <div class="container">

                <nav class="navbar area-menu header-top  navbar-expand-lg navbar-light bg-light">
                    <a class="logo" href="index.html">
                        <img id="logo" src="src/img/logo.svg" alt="Logo" />
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarText">

                        <ul class="navbar-nav ml-md-auto d-md-flex">
                            <li class="nav-item">
                                <a class="nav-link" href="index.html#quemSomos"><i class="fas fa-user"></i> QUEM SOMOS</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="consultar_imoveis.html"><i class="fas fa-user"></i> CONSULTAR IMÓVEIS</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="loginModal.show()" ><i class="fas fa-key"></i> LOGIN</a>
                            </li>
                        </ul>
                    </div>
                </nav>


            </div>

        `
    }
}
