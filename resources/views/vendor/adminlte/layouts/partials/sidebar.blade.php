<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Navegação</li>
            <!-- Optionally, you can add icons to the links -->
            @if(Auth::check())

                <li><a href="{{ url('/search') }}"><i class='fa fa-search'></i> <span>Pesquisar</span></a></li>
                <li><a href="{{ url('/') }}"><i class='fa fa-home'></i> <span>Home</span></a></li>

                <li class="treeview">
                    <a href="#">
                        <i class='fa fa-dollar'></i> <span>Ofertas</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/ofertas') }}"><i class="fa fa-circle-o"></i> Gerenciar</a></li>
                        <li><a href="{{ url('/ofertas/create') }}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class='fa fa-newspaper-o'></i> <span>Necessidades</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/necessidades') }}"><i class="fa fa-circle-o"></i> Gerenciar</a></li>
                        <li><a href="{{ url('/necessidades/create') }}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                    </ul>
                </li>

                <li><a href="{{ url('/contratos') }}"><i class="fa fa-file"></i> <span>Contratos</span></a></li>
                <li><a href="{{ url('/interesses') }}"><i class="	fa fa-hashtag"></i> <span>Interesses</span></a></li>


                <li class="treeview">
                    <a href="#">
                        <i class='fa fa-user'></i> <span>Sua Conta</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/user/edit') }}"><i class="fa fa-circle-o"></i> Editar</a></li>
                        <li><a href="{{ url('/user/password') }}"><i class="fa fa-circle-o"></i> Alterar Senha</a></li>
                        <li><a href="{{ url('/user/confirmarexclusao') }}"><i class="fa fa-circle-o"></i> Excluir Conta</a></li>
                    </ul>
                </li>
               

                 <li class="treeview">
                    <a href="#">
                        <i class='fa fa-map-marker'></i> <span>Cidades</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/cidades') }}"><i class="fa fa-circle-o"></i> Gerenciar</a></li>
                        <li><a href="{{ url('/cidades/create') }}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class='fa fa-bar-chart'></i> <span>Dados</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/dados/contratosRealizados') }}"><i class="fa fa-circle-o"></i> Serviços Realizados</a></li>
                    </ul>
                </li>

                @if(Auth::user()->administrador)
                    <li class="header">Administrador</li>
                    <li class="treeview">
                        <a href="#">
                        <i class='fa fa-cogs'></i> <span>Categorias</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/categorias') }}"><i class="fa fa-circle-o"></i> Gerenciar</a></li>
                            <li><a href="{{ url('/categorias/createmaster') }}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                        <i class='fa fa-book'></i> <span>Relatórios</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/relatorios/categoria') }}"><i class="fa fa-circle-o"></i> Categoria</a></li>
                            <li><a href="{{ url('/relatorios/localizacao') }}"><i class="fa fa-circle-o"></i> Localização</a></li>
                            <li><a href="{{ url('/relatorios/servicosAno') }}"><i class="fa fa-circle-o"></i> Realizados por Ano</a></li>
                        </ul>
                    </li>
                  
                    <li class="treeview">
                        <a href="#">
                        <i class='fa fa-key'></i> <span>Palavras-Chave</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ url('/palavras') }}"><i class="fa fa-circle-o"></i> Gerenciar</a></li>
                            <li><a href="{{ url('/palavras/create') }}"><i class="fa fa-circle-o"></i> Cadastrar</a></li>
                        </ul>
                    </li>
                @endif


            @else
                <li><a href="{{ url('/search') }}"><i class='fa fa-search'></i> <span>Pesquisar</span></a></li>
                <li class=""><a href="{{ url('') }}"><i class='fa fa-home'></i> <span>Home</span></a></li>
                <li><a href="{{ url('/login') }}"><i class='fa fa-sign-in'></i> <span>Entrar</span></a></li>
                <li><a href="{{ url('/register') }}"><i class='fa fa-user'></i> <span>Cadastrar-se</span></a></li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
