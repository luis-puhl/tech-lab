unit Unit1;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls;

type
  CampoTabela = record
    simbolo: string;
    colisao: integer;
  end;
  TForm1 = class(TForm)
    Button1: TButton;
    Label1: TLabel;
    Edit1: TEdit;
    procedure Button1Click(Sender: TObject);
  private
    { Private declarations }
  public
    { Public declarations }
  end;

const
  QuntSimRes = 22;   //Quantidade de s�mbolos reservados.
  SimbolosReservados: array[1..QuntSimRes] of string = ('+','-','*','/','=','.',
  ';',':','"','<','>','<=','>=','<>','(',')','[',']','{','}','..',':=' );

  QuntPalRes = 34;  //Quantidade de palavras reservadas.
  PalavrasReservadas : array[1..QuntPalRes] of string = ('and', 'array','begin,',
  'case','const','div','do','downto','else','end','file','for','func','goto',
  'if','in','label','mod','nil','not','of','packed','proc','progr','record','repeat',
  'set','then','to','type','until','var','while','with' );

var
  Form1: TForm1;
  Tabela: array[1..QuntSimRes+QuntPalRes+3+30] of CampoTabela;

implementation

{$R *.dfm}

//Fun��o hash, que retornar� o valor do simbolo na tabela
function Hash(simbolo: string): Integer;
var
  poscos,i,soma: integer;
begin
//Tabela Primaria varia de 1 a 59
//Tabela Secundaria de 60 a 90
  poscos:=60;
  soma:=0;

  for i:=1 to Length(simbolo) do
  begin
    if (simbolo[i]<>' ') then
      soma:=soma+Ord(simbolo[i]);
  end;

  Hash:=(soma)mod(poscos-1);
end;

//Primeira rotina do programa, criar� uma tabela atrav�s de Hashing para os simbolos
//e palavras reservadas.
procedure CriaTabela();
var
  poscos,i,posant: integer;
begin
  poscos:=60;
  posant:=0;
  for i:=1 to QuntPalRes do
  begin
    if (Tabela[Hash(PalavrasReservadas[i])].simbolo = '') then
    begin
      Tabela[Hash(PalavrasReservadas[i])].simbolo:=PalavrasReservadas[i];
      Tabela[Hash(PalavrasReservadas[i])].colisao:=0;
    end
    else
    begin
      if (Tabela[Hash(PalavrasReservadas[i])].colisao = 0) then
      begin
        while (Tabela[poscos].colisao) <> 0 do
          begin
            poscos:=poscos+1;
          end;
        Tabela[poscos].simbolo:=PalavrasReservadas[i];
        Tabela[poscos].colisao:=0;
        Tabela[Hash(PalavrasReservadas[i])].colisao := poscos;
      end
      else
      begin
        poscos:=Tabela[Hash(PalavrasReservadas[i])].colisao;
        while (Tabela[poscos].colisao) <> 0 do
        begin
          posant:=poscos;
          poscos:=Tabela[poscos].colisao;
        end;
        Tabela[poscos].simbolo:=PalavrasReservadas[i];
        Tabela[poscos].colisao:=0;
        Tabela[posant].colisao := poscos;
      end; //
    end;  //end do else
  end;

//Criando simbolos reservados
for i:=1 to QuntSimRes do
  begin

    if (Tabela[Hash(SimbolosReservados[i])].simbolo = '') then
    begin
      Tabela[Hash(SimbolosReservados[i])].simbolo:=SimbolosReservados[i];
      Tabela[Hash(SimbolosReservados[i])].colisao:=0;
    end
    else
    begin
      if (Tabela[Hash(SimbolosReservados[i])].colisao = 0) then
      begin
        while (Tabela[poscos].colisao) <> 0 do
          begin
            poscos:=poscos+1;
          end;
        Tabela[poscos].simbolo:=SimbolosReservados[i];
        Tabela[poscos].colisao:=0;
        Tabela[Hash(SimbolosReservados[i])].colisao := poscos;
      end
      else
      begin
        poscos:=Tabela[Hash(SimbolosReservados[i])].colisao;
        while (Tabela[poscos].colisao) <> 0 do
        begin
          posant:=poscos;
          poscos:=Tabela[poscos].colisao;
        end;
        Tabela[poscos].simbolo:=SimbolosReservados[i];
        Tabela[poscos].colisao:=0;
        Tabela[posant].colisao := poscos;
      end; //
    end;  //end do else
  end;

end;

Fun��o que procura uma cadeia de caracteres na tabela gerada por Hashing
function ProcuraTabela(entrada:string) : Boolean;
begin
  ProcuraTabela:=True;
end;

procedure TForm1.Button1Click(Sender: TObject);
begin
Label1.Caption:=IntToStr(Hash(Edit1.Text));
CriaTabela;  //Cria��o da Tabela


end;

end.