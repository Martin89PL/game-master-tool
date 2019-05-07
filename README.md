# Małe, konsolowe narzędzie Mistrza Gry

Witaj Wędrowcze, twoim dzisiejszym zadaniem jest stworzenie małej konsolowej aplikacji, której funkcje pomocne być muszą wszechmocnemu Mistrzowi Gry. Bez wątpienia, zadanie nie należy do najłatwiejszych, lecz nie lękaj się, bowiem mechanizm, który przyjdzie Ci implementować jest skądinąd najprostszym z możliwych. Udaj się zatem czym prędzej na [stronicę](http://onepagerpg.com/index.html) by dowiedzieć się więcej.

Narzędzie przyjmować ma tekstowe komendy Mistrza Gry, który w swej nieomylności wpisywać je będzie na standardowe wejście, a odpowiedź ze swej nowej wyroczni otrzyma na standardowe wyjście.

Treść zadania zawiera uproszczone zasady systemu [CRAM](http://onepagerpg.com/files/CRAM.pdf), co w tym wypadku znaczy, że nie implementują one spalania szczęścia za dodatkowy rzut kością. Wszystkie kości to **1d6**.

**Opisane poniżej wytyczne są tylko niezbędnym minimum, zachęcamy wszystkich uczestników do radosnej twórczości i rozszerzenia standardowych komend.**

## Tworzenie uczestnika gry
Komendą tworzącą uczestnika gry, np. gracza lub potwora jest:
```
add Name x PHY x MEN x VIT x LUC Skill1 Skill2
```
Uczestnik gry charakteryzowany jest przez 4 atrybuty: _PHY_, _MEN_, _VIT_ oraz _LUC_. Szerszy opis atrybutów znajdziesz w opisie systemu [CRAM](http://onepagerpg.com/files/CRAM.pdf). Mistrz Gry przypisuje uczestnikowi **20 punktów**, które rozdysponowuje pomiędzy wyżej wymienione atrybuty. Punktów nie można dzielić, a przypisana do atrybutu liczba punktów nie może być mniejsza od 1 ani większa od 15. Uczestnik otrzymuje również złoto, którego ilość zależy od atrybutu _LUC_. Liczba złotych monet liczona jest zgodnie z wzorem _LUC * 15_.

Uczestnik ma również przypisane dwie spośród następujących umiejętności: _Athletics_, _Lore_, _Martial_, _Medicine_, _Psionics_, _Rhetoric_, _Science_, _Subterfuge_, _Survival_ oraz _Vocation_. Szerszy opis umiejętności znajdziesz w opisie systemu [CRAM](http://onepagerpg.com/files/CRAM.pdf).

Przykład:
```
add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics
The Oracle: The being Johan JQuery has been created.
```

## Zakup ekwipunku
Za posiadane złoto uczestnicy mogą nabywać zdefiniowany w systemie ekwipunek.
```
Name buys ItemName
```
Ekwipunek jest podzielony na trzy kategorie: _Gear_, _Weapons_ oraz _Armor_.  Broń modyfikuje atrybut _PHY_ (walka w zwarciu) lub ma przypisaną liczbę kostek wykorzystywaną podczas ataku (walka na odległość). Pancerz redukuje obrażenia oraz zmniejsza atrybut _PHY_. Sprzęt jest ogólną kategorią zawierającą przedmioty o określonych przez Mistrza Gry właściwościach (aczkolwiek nie jest on istotny w tym zadaniu).

Przykład:
```
Johan JQuery buys ProgrammersRespect
The Oracle: Johan JQuery does not have enough gold.
```

## Standardowy modyfikator
Mistrz Gry ma możliwość ustalenia poziomu trudności rozgrywanej gry. Wykorzystuje do tego standardowy modyfikator, które zmienia liczbę kości wykorzystywaną podczas ataku oraz sprawdzenia umiejętności. Standardowy modyfikator ma następujące postacie:
- trivial: +5,
- easy: 0,
- moderate: -5,
- difficult: -10,
- nearly impossible: -15.

Komenda zmieniająca trudność gry ma postać:
```
set difficulty StandardModifier
```
Przykład:
```
set difficulty nearly impossible
The Oracle: The world is now a better place.
```

## Atak
Uczestnicy gry mogą się nawzajem atakować. Atak _może_ zakończyć się redukcją atrybutu _VIT_. Gdy atrybut _VIT_ uczestnika jest mniejszy niż 1 zostaje on uznany za martwego i nie bierze udziału w dalszej grze.
```
AttackerName attacks PreyName
```
Atak polega na wyliczeniu liczby kości, wg. atrybutu _PHY_, modyfikatora wynikającego z broni do walki w zwarciu oraz umiejętności _Martial_. Przykład 1: _PHY_ uczestnika wynosi 10, posiada on broń białą _PHY+1_ oraz ma umiejętność _Martial_, co daje `10+1+1=12` kości. Przykład 2: _PHY_ uczestnika wynosi 11, posiada on broń białą _PHY+2_ oraz nie ma umiejętność _Martial_, co daje `11+2+0=13` kości.

W przypadku gdy uczestnik posiada broń dystansową, wyliczona wyżej wartość jest porównywana z liczbą kości przypisaną do broni. Wybierana jest możliwie najwyższa wartość. Przykład: _PHY_ uczestnika wynosi 5, posiada on broń dystansową (11 kostek) oraz ma umiejętność _Martial_, co daje `5+0+1=6` w porównaniu z `11` kośćmi wynikającymi z broni dystansowej. Uczestnik atakuje zatem z dystansu.

W kolejnym kroku liczba kości zmieniana jest przez standardowy modyfikator. Przykład: uczestnik ma 10 kości, a standardowy modyfikator ustawiony jest na _moderate_, zatem ostateczna liczba kości to 5.

Zadane obrażenia określane są na podstawie liczby wyrzuconych na kościach jedynek. Otrzymana liczba obniżana jest przez wynikającą z pancerza ofiary redukcję. Przykład: Atakujący ma atak na poziomie 10 kostek, 4 rzuty były jedynkami, redukcja obrażeń jest równa 1, zatem poniesione obrażenia wynoszą 3, tzn. redukcja atrybutu _VIT_ ofiary o 3 punkty.

## Sprawdzenie zdolności
W czasie gry, Mistrz Gry może poddać próbie uczestnika za pomocą mechanizmu sprawdzenia zdolności, to czy dana czynność w grze zostanie wykonana czy nie zależy od szczęścia oraz charakterystyki uczestnika.

Mistrz Gry określa które atrybuty oraz umiejętności zostaną wzięte pod uwagę przy sprawdzeniu zdolności. Komenda sprawdzająca ma następującą formę:
```
check ability Name PHY... [Skill...]
```
Liczba kości wyznaczana jest na podstawie liczby punktów wskazanego atrybutu. Jeżeli podany jest więcej niż jeden atrybut, wówczas brany pod uwagę jest ten z najmniejszą liczbą przypisanych punktów. Następnie, liczbę kości ogranicza się zakresami: od 1 do 7, gdy uczestnik nie ma żadnej z podanych w komendzie opcjonalnych umiejętności lub od 2 do 13 gdy posiada co najmniej jedną z podanych umiejętności.

W ostatnim kroku liczba kości modyfikowana jest przez standardowy modyfikator.

Czynność uznaje się za wykonaną jeżeli na co najmniej jednej kości wypadnie 1. Gdy wypadnie 6, rzut kością jest powtarzany. W przypadku gdy wszystkie kości wskażą 5, wówczas następuje krytyczna porażka, którą oznaczamy odpowiednim komunikatem.

## Wyrazy uznania
Zadanie wzorowane jest doskonałym systemem RPG [CRAM](http://onepagerpg.com/files/CRAM.pdf), którego autorem jest  Rusty Gerard.



