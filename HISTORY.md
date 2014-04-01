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


==============================================================================
Modificado o campo e-mail da licesa em cada arquivo;



