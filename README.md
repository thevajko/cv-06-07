# VAII Cvičenie 06 a 07
Momentálne je otvorená branch __MAIN__, ktorá obsahuje _štartér_. 
Riešenie obsahuje dve branche pre riešenie:
1. __SOLUTION_06__
2. __SOLUTION_07__

## Úlohy pre cvičenie 06

1. Pridanie modelu pre post
   1. Vytvorte triedu pre model postu. Ten bude obsahovať atribúty `text` a `picture`.
   2. Do _DB_ doplníte odpovedajúcu tabuľku a vložte aspoň dva riadky. Url obrázka môže byť externá.
2. Zobrazenie postov
   1. Zobrazte posty na homepage. Použite snippet `snippets/post.snippet.view.php` a dopasujte zobrazenie dát
3. Pridávanie postov
   1. Pre posty vytvorte nový controller `PostController`
   2. Pridajte mu metódu pre zobrazenie formuláru príspevku (`showForm()`) a jeho pridanie do DB (`add`). Do formulára, ako obrázok vkladajte iba URL.
   3. Pridajte link na pridanie príspevku do hlavného menu
   4. Doplníte logiku pre uloženie formulára do DB a po jeho uložení presmerujte používateľa na homepage
5. Mazenie postov
   1. K postu pridáme tlačidlo, ktorým daný post vymažeme
6. Editácia postov
   1. K postu pridáme tlačidlo, ktorým daný budeme editovať
   2. Na editáciu použijeme formulár pre pridávanie postov
7. Upload obrázka
   1. Upravte formulár tak, aby vedel odosielať súbory
   2. Spracujte uploaduté súbory tak, aby sa ukladala na náš webový server a v poste sa zobrazil ten
   3. Ošetrite problem, aby používatelia mohlo uploadovať odlišné súbory s rovnakým názvom a neprepisovali si ich navzájom.

## Úlohy pre cvičenie 07

1. Prihlasovanie
   1. Vytvorte potomka triedy `DummyAuthenticator` a upravte proces prihlasovania tak, aby bol používateľ prihlásený ak sa jeho login a heslo rovnajú.
   2. Opravte nastavenia aplikácie tak, aby sa používal nový spôsob prihlásenia.
   3. V menu položku pre pridanie postu zobrazte iba prihláseným.
   4. Všetky akcie v kontrolery postov budú iba pre prihlásených
2. Zobrazte autora postu
   1. Upravte model pre posty tak, aby si pamätal login jeho autora
   2. Autora zobrazte v postoch na home page
   3. Autora doplníme pri pridávaní nového postu
3. Pridanie lajkovania
   1. Treba vytvoriť nový model
   2. Doplniť logiku pre lakjovania a zobrazenia poctu lajkov príspevku
   3. Doplniť na zobrazenie postu tlačidlo pre lajkovanie s počtom likov
4. Pridanie authorizacie
   1. Update a Delete operácie nad postom, môže len jeho prihlásený autor
   2. Doplňte príslušné akcie k postom na úvodnej stránke

4. Doplníte kontrolu vstupov do formulára. Pri chybe je potrebné farebne vyznačiť chybný element a pri ňom aj chybovú hlášku. Pokiaľ boli v poliach hodnoty je potrebné ich zobraziť (aby to používateľ nemusel vypĺňať nanovo). Kontrolovať sa má:
   * Či je súbor obrázok
   * Či je súbor vôbec odoslaný = príspevok musí obsahovať obrázok
   * Či je vôbec odoslaný text postu = príspevok musí obsahovať text
   * Text príspevku musí byť väčší ako 2 znaky


## Ako nájsť branch môjho cvičenia?
Pokiaľ sa chcete dostať k riešeniu z cvičenia je potrebné otvoriť si príslušnú _branch_, ktorej názov sa skladá:

__MIESTNOST__ + "-" + __HODINA ZAČIATKU__ + "-" + __DEN__

Ak teda navštevujete cvičenie pondelok o 08:00 v RA323, tak sa branch bude volať: __RA323-08-PON__

# Použitý framework

Cvičenie používa framework vaiicko dostupný na repe [https://github.com/thevajko/vaiicko](https://github.com/thevajko/vaiicko)
