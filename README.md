# SISATE


This is a CodeIgniter project used by some agencies of Social Security in Brazil. More details about this project are written in portuguese in the next section.

### Colophon:

* CodeIgniter 3.0.0
* Doctrine
* Bootstrap
* [Bootstrap Material design](https://github.com/FezVrasta/bootstrap-material-design)
* [Bootstrap Validator](https://github.com/1000hz/bootstrap-validator)
* [Bootstrap Table](https://github.com/wenzhixin/bootstrap-table)
* [X-editable](https://github.com/vitalets/x-editable)
* [jQuery Mask Plugin](https://github.com/igorescobar/jQuery-Mask-Plugin)
* Gulp

## Porque esse sistema existe?

Esse sistema foi criado para melhorar o fluxo do processo físico que depende da análise médica de PPPs. O servidor da APS digitaliza o processo e o encaminha para o SST. O chefe da SST distribui para um de seus médicos, que faz a análise do processo

A autenticação do usuário é provida pelo SISREF. O cadastramento de usuários por uns administrador é opcional, mas o usuário é cadastrado automaticamente em seu primeiro acesso.

## TODO

Algumas partes do código estão comentadas com TODO indicando o que precisa ser feito. Demais itens:

- [ ] Melhorar a legibilidade do código adequando-o ao PHP Style Guide (http://www.codeigniter.com/userguide3/general/styleguide.html)
- [ ] Melhorar a minificação de arquivos usando tasks do Gulp
- [ ] Implementar na classe Usuario data do último acesso
- [ ] Criar funcionalidade para alterar número do benefício
- [ ] Log de acesso