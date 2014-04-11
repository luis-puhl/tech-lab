25.03.2014 18:08:41 
==============================================================================
Trabalhando com a biblioteca de anotações para estabelecer um padrão melhor 
formado para construção de sistemas mais complexos;

Arquitetura:
        browser acessa uma página,
        a aplicação dispara o boot.php;

        cada tabela tem um model, descendentes de Model.php

Continuar em Model.php, criar um caso de teste;


27.03.2014 14:58:08 
==============================================================================
Conjunto de model funcionado, apensas com atributos públicos da classe 
model implementada (Person.php);

Script de testes também adicionado;

Planejando publicar este projeto no gitHub, removi informações sensíveis;


27.03.2014 16:54:01
==============================================================================
Criado o repositório git, publicando esta consolidação para o gitHub;


27.03.2014 18:06:05 
==============================================================================
Class Autoload foi posto para funcionar, de acordo com a hierarquia do 
projeto;

HG está corrompido, Field.php foi sobreescrito em Person.test.php ao invez 
de Person_test.php;

Posto em funcionamento o autoload para todo o projeto;

Adicionado uma anotação, ainda sem uso;

Centralizado os parâmetros de conexão;

Melhorado a integridade e foco no objetivo do Model.php;

28.03.2014 17:12:04
==============================================================================
Criado método para carregar todos os registros, e outro abstrato para criar 
uma sql com o mínimo de campos possíveis;

Começo da documentação do Model;

Adicionado ao model, filtragem por annotation de campo (Field);

01.04.2014 15:00:00
==============================================================================
Modificado o campo e-mail da licesa em cada arquivo;

01.04.2014 15:05:16
==============================================================================
Adicionado config.php, para centralizar a configuração de conexão com o banco;

08.04.2014 13:40:52 
==============================================================================
Adicionados os diretórios:
	pages/		Paginas e módulos;
	helper/		Trechos para reuso de html;
	css/		Folhas de estilo;
	js/			Sripts de navegador (JavaScript).
Modificado o boot.php para incluir estes diretórios;

Modificado MysqlConnection.php para lançar excessão se nenhum registro é 
recuperado;

Removido os pontos de depuração (echo) do script Model.php;

Adicionado índice (index.php) para acesso rápido das páginas de teste;

Adicionado página person mostrando o modelo de uma pagina associado a um Model;

08.04.2014 14:51:40
==============================================================================
Adicionado folha de estilos 'main';

Adicionado funções getCss e getJs para o boot.php, que geram o html de 
ligação para Folha de Estilo e Script de Browser respectivamente;

Melhorado a padronização de código e reparado alguns erros lógicos (veja diff);

Adicionado serviço ajax com composição de pagina de listagem (melhorar);

09.04.2014 16:42:13 
==============================================================================
Adiconado Exception personalizada para controller, apenas para recuperar 
erros no cotroller;

Melhorado person.php para tratar melhor excessões (de acordo com o item 
anterior), modificado os scripts abaixo para acompanhar esta alteração:
	person_compact.php;
	person_full.php;

Melhorado o browser script ajax.js, testado em person_list.php;

Adicionado função getHTTPHeaderByCode que retorna um cabeçalho HTTP 
formatado de acordo com o status da resposta HTTP;

10.04.2014 14:21:26
==============================================================================
Melhorado o layout de erro ajax;

Adiconado a função 'getPageURL' para recuperar URL de páginas (verifica se a 
página existe);

Corrigido bug de acessibilidade com o JavaScript desabilitado;

Criado função JavaScript para enviar formulários, com isso, criado mecanismo 
de envio de ações a partir de AJAX;

Codigo JavaScript de envio AJAX para person foi extraido e melhorado;

11.04.2014 17:22:32
==============================================================================
Criado paginação de registros, melhorar;
