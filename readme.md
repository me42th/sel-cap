# Teste Desenvolvedor PHP - David Meth

## PHP :heavy_plus_sign: SQL SERVER

<details>
  <summary>QUESTÃO 1</summary>
  <p>
    Criar um banco de dados utilizando a linguagem SQL chamado polivalência de
acordo com as considerações abaixo:
</p>
<p>
    O funcionário deve possuir características como nome, data de nascimento,
cidade, telefone.
</p>
<p>
    O posto de trabalho deve conter informações do setor do posto, nome do
posto e tipo do posto.
</p>
<p>
    O banco de dados deve ser capaz de permitir a polivalência (o funcionário
pode ser habilitado a diversos postos de trabalho). E a habilitação de cada
funcionário deve conter uma data de validade.
  </p>
<p>
   Crie uma consulta SQL que devolva os funcionários habilitados ao posto de trabalho
    “São Paulo” com mais de 1 mês de habilitação com base na data atual.</p>
</p>

</details>
 
**RESPOSTA**

```
create database polivalencia;
use polivalencia;
```

```
CREATE TABLE `funcionario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(48) NOT NULL,
  `cidade` varchar(48) DEFAULT NULL,
  `telefone` varchar(48) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `_upstuff` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

```

```
CREATE TABLE `posto` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(48) NOT NULL,
  `tipo` varchar(48) DEFAULT NULL,
  `info_setor` longtext,
  `_upstuff` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

```

```
CREATE TABLE `habilitacao` (
  `id_funcionario` int(10) unsigned NOT NULL,
  `id_posto` int(10) unsigned NOT NULL,
  `validade` datetime NOT NULL,
  `inicio` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_posto` (`id_posto`),
  CONSTRAINT `habilitacao_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  CONSTRAINT `habilitacao_ibfk_2` FOREIGN KEY (`id_posto`) REFERENCES `posto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


```


<details>
  <summary>QUESTÃO 2</summary>
  <p> Crie uma consulta SQL que devolva os funcionários habilitados ao posto de trabalho
“São Paulo” com mais de 1 mês de habilitação com base na data atual.</p>
</details>

**RESPOSTA**
```
select funcionario.nome as FUNCIONARIO, funcionario.cidade as ORIGEM , 'São Paulo' as UNIDADE from funcionario join habilitacao on habilitacao.id_funcionario = funcionario.id join posto on habilitacao.id_posto = posto.id where (unix_timestamp(now()) - unix_timestamp(habilitacao.inicio)) / (60*60*24*30) >= 1 and posto.nome = 'São Paulo' group by funcionario.id;
```

## SQL

<details>
  <summary>QUESTÃO 1</summary>
  <p> Crie um script em SQL para inserir dados em cada tabela. </p>
</details>

![image](https://user-images.githubusercontent.com/26856017/67603914-99b91a00-f750-11e9-944e-14b08760e956.png)


**RESPOSTA**
```
insert into marca values 
(10,'Valfenda','br','fornecedor',default),
(16,'outro','br','fornecedor',default),
(7,'nulo','br','fornecedor',default),
(25,'negativo','br','fornecedor',default);
```

```
insert into produtos values
(default,'produto a','10',10),
(default,'produto b','10',16),
(default,'produto c','10',7),
(default,'produto d','10',25);
```

<details>
  <summary>QUESTÃO 2</summary>
  <p> Crie uma consulta em SQL que liste os Id e Nome dos produtos que seja da marca
“Valfenda”. </p>
</details>

**RESPOSTA**
```
select produtos.id as ID, produtos.nome as PRODUTO from produtos join marca on produtos.id_marca = marca.id where
marca.nome = 'Valfenda';
```

## NoSql

<details>
  <summary>QUESTÃO 1</summary>
  <p> Explique com poucas palavras o que entede sobre o tema “Banco NoSql” e cite um
exemplo de um banco. </p>
</details>

**RESPOSTA**
> NoSQL sigla atribuida a bancos não relacionais, banco que fornece persistencia e crud viabilizados sem a estrutura tabelar do bancos sql, relacionais.

1. Mongo DB
2. Cassandra

## Laravel

<details>
  <summary>QUESTÃO 1</summary>
  <p> Crie uma Api usando o framework Laravel que retorne os funcionários que trabalham
no Brasil. </p>
</details>

> Para esta questão foi aproveitada a estrutura elaborada na seção **PHP + SQL Server**

1. composer update
2. .env 
    1.  DB_DATABASE=polivalencia
3. php artisan serve
4. vscode
    1. extensão rest client
    2. arquivo ./endpoint.http >> send request

## PHP e Orientação a Objetos
        
<details>
  <summary>QUESTÃO 1</summary>
  <p> Qual a diferença entre protected, private, public? </p>
</details>        

1. Public       **visto em qualquer parte do codigo**
2. Private      **apenas na classe que foi declarado**
3. Protected    **apenas na classe que declarou e que extendeu, herança**
