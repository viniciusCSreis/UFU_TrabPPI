class Login_modal
{
    constructor(elemento)
    {
        this._elemento=elemento;
    }
    create()
    {
        this.create_modal_login();
    }
    show()
    {
        $('#loginModal').modal('show');
    }
    create_modal_login()
    {
        this._elemento.innerHTML =
        `




        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control"  name="email"id="email" aria-describedby="emailHelp" placeholder="Digite seu e-mail">

                            </div>
                            <div class="form-group">
                                <label for="Password">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="Check">
                                <label class="form-check-label" for="Check">Lembrar minha senha</label>
                            </div>
                            <br>
                            <div class="form-group">
                                <a href="#">Esqueci minha senha</a> &nbsp;&nbsp;&nbsp;
                                <!--<a href="#" data-toggle="modal" data-target="#cadastroModal">Novo Cadastro</a>-->
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <div id="mensagemErro" style="display:none; color: red;">Login invalido</div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                        <button type="button" onclick="submitLogin()" class="btn btn-primary"> Entrar </button>

                    </div>

                </div>
            </div>
        </div>

        `
    }
}
