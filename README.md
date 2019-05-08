# Narzędzie wspomagające prowadzenie sesji RPG

Zadaniem uczestników **Coding Dojo Silesia** jest zaimplentowanie konsolowego narzędzia wspomagającego prowadzenie sesji RPG opartych o system [CRAM](http://onepagerpg.com/files/CRAM.pdf). [CRAM](http://onepagerpg.com/files/CRAM.pdf) jest to jednostronicowy dokument zawierający zbiór reguł i mechanik prostego systemu RPG. W zadaniu należy zaimplementować kompletne zasady systemu z wyłączeniem spalania punktów szczęścia (atrybut _LUC_) za dodatkowy rzut kością. Dostępne w programie komendy zostały zaprezentowane poniżej.

W systemie [CRAM](http://onepagerpg.com/files/CRAM.pdf) powodzenie wszystkich czynności jest zależne od rzutów standardowymi kośćmi 1d6.

## Lista dostępnych komend

Poniżej znajduje się lista komend, które Mistrz Gry będzie wprowadzał na standardowe wejście programu. Aplikacja powinna każdorazowo powiadomić użytkownika o sukcesie bądź porażce wykonania komendy za pomocą komunikatu wyświetlonego na standardowym wyjściu. Mistrz Gry może **stworzyć uczestnika gry**, **ustawić standardowy modyfikator gry**, **zakupić ekwipunek uczestnikowi**, **wykonać atak jednego uczestnika na drugim uczestniku**, a także **sprawdzić czy uczestnik może wykonać pewną czynność**.

### Tworzenie uczestnika gry
Komendą tworzącą uczestnika gry (np. gracza lub potwora) jest:
```console
add ParticipantName x PHY x MEN x VIT x LUC Skill1 Skill2
```
Uczestnik gry charakteryzowany jest przez 4 atrybuty: _PHY_, _MEN_, _VIT_ oraz _LUC_ (szerszy opis atrybutów znajdziesz w opisie systemu [CRAM](http://onepagerpg.com/files/CRAM.pdf)). Mistrz Gry przypisuje uczestnikowi **20 punktów**, które rozdysponowuje pomiędzy wyżej wymienione atrybuty. Punktów nie można dzielić, a przypisana do atrybutu liczba punktów nie może być mniejsza od 1 ani większa od 15. Uczestnik otrzymuje również złoto, którego ilość zależy od atrybutu _LUC_. Liczba złotych monet liczona jest zgodnie z wzorem _LUC * 15_.

Uczestnik ma dodatkowo przypisane dwie spośród następujących umiejętności: _Athletics_, _Lore_, _Martial_, _Medicine_, _Psionics_, _Rhetoric_, _Science_, _Subterfuge_, _Survival_ oraz _Vocation_ (szerszy opis umiejętności znajdziesz w opisie systemu [CRAM](http://onepagerpg.com/files/CRAM.pdf)).

Przykład:
```console
add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics
The Oracle: The being Johan JQuery has been created.
```

### Zakup ekwipunku
Za posiadane złoto uczestnicy mogą nabywać zdefiniowany ekwipunek.
```console
ParticipantName buys ItemName
```
Ekwipunek jest podzielony na trzy kategorie: _Gear_, _Weapons_ oraz _Armor_. Broń modyfikuje atrybut _PHY_ (broń do walki w zwarciu) lub ma przypisaną stałą (niezależną od atrybutów i umiejętności) liczbę kostek wykorzystywaną podczas ataku (broń do walki na odległość). Pancerz redukuje obrażenia oraz zmniejsza atrybut _PHY_. Sprzęt jest ogólną kategorią zawierającą przedmioty o niesprecyzowanym działaniu i przeznaczeniu.

Przykład:
```console
Johan JQuery buys ProgrammersRespect
The Oracle: Johan JQuery does not have enough gold.
```

### Standardowy modyfikator gry
Mistrz Gry ma możliwość ustalenia poziomu trudności rozgrywanej gry. Wykorzystuje do tego standardowy modyfikator gry, który wpływa na liczbę kości wykorzystywaną podczas ataku oraz sprawdzenia zdolności. Standardowe modyfikatory mają następujące nazwy i wartości:
- trivial: +5,
- easy: 0,
- moderate: -5,
- difficult: -10,
- nearly impossible: -15.

Komenda zmieniająca trudność gry ma postać:
```console
set difficulty StandardModifier
```
Przykład:
```console
set difficulty nearly impossible
The Oracle: The world is now a better place.
```

### Atak
Uczestnicy gry mogą się atakować. Atak kończy się redukcją atrybutu _VIT_ uczestnika atakowanego, a gdy wartość atrybutu _VIT_ uczestnika jest mniejsza niż 1 zostaje on uznany za martwego i nie bierze udziału w dalszej grze.
```console
AttackerName attacks PreyName
```

Zadane obrażenia równe są liczbie jedynek, które wypadły na rzuconych kostkach. Liczba rzucanych kostek zależy od posiadanego przez uczestników ekwipunku oraz ich atrybutów i umiejętności. Atak może być atakiem w zwarciu lub z dystansu, ocenianie są obie możliwości i wybierana jest ta, która ma większą liczbę kostek. Patrz poniższy pseudokod: 
```pascal
liczbaKostek := 
	atrybut PHY uczestnika atakujacego
	+ modyfikatory wszystkich posiadanych broni do walki wrecz
	+ jezeli atakujacy posiada umiejetnosc 'Martial' dodaj 1
if (liczba kostek jest mniejsza o liczby kostek wynikajacych z posiadanych broni do walki na odleglosc) {
	liczbaKostek := liczby kostek wynikajacych z posiadanych broni do walki na odległosc
}
```
Otrzymana liczba kostek jest modyfikowana za pomocą standardowego modyfikator gry:
```pascal
liczbaKostek := liczbaKostek + standardowyModyfikator
```
Program wykonuje symulację rzutów kostkami i bada liczbę wyrzuconych jedynek:
```pascal
wykonaj rzut kostkami wg. uzyskanej liczby kostek
liczbaJedynek := liczba wyrzucanych jedynek
```
Finalne obrażenia zadane uczestnikowi atakowanemu są zmniejszane o wartość redukcji obrażeń:
```pascal
obrazenia := liczbaJedynek - redukcja obrazen wynikajaca z pancerzy uczestnika atakowanego
if (obrazenia > 0) {
	zmniejsz atrybut VIT uczestnika atakowanego o wartosc obrazen
}
```

### Sprawdzenie zdolności
W czasie gry, Mistrz Gry może poddać próbie uczestnika za pomocą mechanizmu sprawdzenia zdolności. Mistrz Gry określa które atrybuty oraz umiejętności zostaną wzięte pod uwagę przy sprawdzeniu zdolności. Komenda sprawdzająca ma następującą formę:
```console
check ability Name ATR1 ATR2... [Skill1 Skill2...]
```

Liczba kostek zależy od wartości przypisanej do podanych w komendzie atrybutów oraz posiadanych umiejęstności:
```pascal
atrybut := wybierz atrybut z najmniejsza liczba przypisanych punktow z listy atrybutow przekazanych w komendzie
if (uczestnik gry posiada co najmniej jedna z umiejetnosci przekazanych w komendzie) {
	liczbaKostek := clamp(pobierzPunkty(atrybut), 2, 13)
} else {
	liczbaKostek := clamp(pobierzPunkty(atrybut), 1, 7)
}
```
Otrzymana liczba kostek jest modyfikowana za pomocą standardowego modyfikator gry:
```pascal
liczbaKostek := liczbaKostek + standardowyModyfikator
```
Program wykonuje symulację rzutów kostkami i bada liczbę wyrzuconych oczek:
```pascal
wykonaj rzut kostkami wg. uzyskanej liczby kostek i gdy wypadnie 6 oczek powtorz rzut
if (wszytkie kostki mialy wartosc 5) {
	wykonanie czynnosci zakonczone krytyczną porazka 
} else if (co najmniej jedna kostka miala wartosc 1) {
	wykonanie czynnosci zakonczone sukcesem
} else {
	wykonanie czynnosci zakonczone porazka
}
```

Przykład:
```console
check ability Johan JQuery PHY Lore Medicine
The Oracle: The result: critical failure
```

## Wyrazy uznania
Zadanie wzorowane jest doskonałym systemem RPG [CRAM](http://onepagerpg.com/files/CRAM.pdf), którego autorem jest  Rusty Gerard.
