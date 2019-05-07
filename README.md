# Małe, konsolowe narzędzie Mistrza Gry

Witaj Wędrowcze, twoim dzisiejszym zadaniem jest stworzenie małej konsolowej aplikacji, której funkcje pomocne być muszą wszechmocnemu **Mistrzowi Gry**. Bez wątpienia, zadanie nie należy do najłatwiejszych, lecz nie lękaj się, bowiem mechanizm, który przyjdzie Ci implementować jest skądinąd najprostszym z możliwych. Udaj się zatem czym prędzej na taką oto [stronicę](http://onepagerpg.com/index.html) by dowiedzieć się więcej.

Narzędzie przyjmować ma tekstowe komendy Mistrza Gry, który w swej nieomylności wpisywać je będzie na standardowe wejście, a odpowiedź ze swej wyroczni otrzyma on na standardowe wyjście.

W zadaniu tym, wzorować się będziesz na stworzonych przez wybitnego mędrca zasadach [CRAM](http://onepagerpg.com/files/CRAM.pdf), lecz porzucić musisz idee spalania szczęścia za dodatkowy rzut kością. Wszystkie kości to **1d6**, a musisz wiedzieć, że pełnią one pierwszoplanową rolę. Bowiem, za ich pomocą określać będziesz zadawane podczas ataków obrażenia, jak również oceniać będziesz zdolności bohaterów i potworów.

### Tworzenie uczestnika gry
Komendą tworzącą uczestnika gry, np. gracza lub potwora jest:
```
add Name x PHY x MEN x VIT x LUC Skill1 Skill2
```
Uczestnik gry charakteryzowany jest przez 4 atrybuty: _PHY_, _MEN_, _VIT_ oraz _LUC_ (szerszy opis atrybutów znajdziesz w opisie systemu [CRAM](http://onepagerpg.com/files/CRAM.pdf)). Mistrz Gry przypisuje uczestnikowi **20 punktów**, które rozdysponowuje pomiędzy wyżej wymienione atrybuty. Punktów nie można dzielić, a przypisana do atrybutu liczba punktów nie może być mniejsza od 1 ani większa od 15. Uczestnik otrzymuje również złoto, którego ilość zależy od atrybutu _LUC_. Liczba złotych monet liczona jest zgodnie z wzorem _LUC * 15_.

Uczestnik ma dodatkowo przypisane dwie spośród następujących umiejętności: _Athletics_, _Lore_, _Martial_, _Medicine_, _Psionics_, _Rhetoric_, _Science_, _Subterfuge_, _Survival_ oraz _Vocation_ (szerszy opis umiejętności znajdziesz w opisie systemu [CRAM](http://onepagerpg.com/files/CRAM.pdf)).

Przykład:
```
add Johan JQuery 1 PHY 2 MEN 1 VIT 15 LUC Lore Psionics
The Oracle: The being Johan JQuery has been created.
```

### Zakup ekwipunku
Za posiadane złoto uczestnicy mogą nabywać zdefiniowany w systemie ekwipunek.
```
Name buys ItemName
```
Ekwipunek jest podzielony na trzy kategorie: _Gear_, _Weapons_ oraz _Armor_. Broń modyfikuje atrybut _PHY_ (broń do walki w zwarciu) lub ma przypisaną liczbę kostek wykorzystywaną podczas ataku (broń do walki na odległość). Pancerz redukuje obrażenia oraz zmniejsza atrybut _PHY_. Sprzęt jest ogólną kategorią zawierającą przedmioty o niesprecyzowanym działaniu i przeznaczeniu.

Przykład:
```
Johan JQuery buys ProgrammersRespect
The Oracle: Johan JQuery does not have enough gold.
```

### Standardowy modyfikator
Mistrz Gry ma możliwość ustalenia poziomu trudności rozgrywanej gry. Wykorzystuje do tego standardowy modyfikator, które zmienia liczbę kości wykorzystywaną podczas ataku oraz sprawdzenia zdolności. Standardowe modyfikatory mają następujące wartości:
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

### Atak
Uczestnicy gry mogą się atakować. Atak kończy się redukcją atrybutu _VIT_ uczestnika atakowanego. Gdy atrybut _VIT_ uczestnika jest mniejszy niż 1 zostaje on uznany za martwego i nie bierze udziału w dalszej grze.
```
AttackerName attacks PreyName
```
Zadawane obrażenia są wyliczane na podstawie następującego algorytmu:
```
liczbaKostek := 
	atrybut PHY uczestnika atakującego
	+ modyfikatory wszystkich posiadanych broni do walki wręcz
	+ jeżeli atakujący posiada umiejętność _Martial_ dodaj 1
if (liczba kostek jest mniejsza o liczby kostek wynikających z posiadanych broni do walki na odległość) {
	liczbaKostek := liczby kostek wynikających z posiadanych broni do walki na odległość
}
liczbaKostek := liczbaKostek + standardowyModyfikator
wykonaj rzut kostakami wg. liczby kostek
liczbaJedynek := liczba wyrzucanych jedynek
obrazenia := liczbaJedynek - redukcja obrażeń wynikająca z pancerzy uczestnika atakowanego
if (obrazenia > 0) {
	zmniejsz atrybut VIT uczestnika atakowanego o wartość obrażeń
}
```

### Sprawdzenie zdolności
W czasie gry, Mistrz Gry może poddać próbie uczestnika za pomocą mechanizmu sprawdzenia zdolności, to czy dana czynność w grze zostanie wykonana czy nie zależy od szczęścia oraz charakterystyki uczestnika.

Mistrz Gry określa które atrybuty oraz umiejętności zostaną wzięte pod uwagę przy sprawdzeniu zdolności. Komenda sprawdzająca ma następującą formę:
```
check ability Name ATR1 ATR2... [Skill1 Skill2...]
```

Mechanizm sprawdzenia umiejętności działa wg. następującego algorytmu.
```
atrybut := wybierz atrybut z najmniejszą liczbą przypisanych punktów z listy atrybutów przekazanych w komendzie
if (uczestnik gry posiada co najmniej jedną z umiejętności przekazanych w komendzie) {
	liczbaKostek := clamp(pobierzPunkty(atrybut), 2, 13)
} else {
	liczbaKostek := clamp(pobierzPunkty(atrybut), 1, 7)
}
liczbaKostek := liczbaKostek + standardowyModyfikator
wykonaj rzut kostakami wg. liczby kostek, gdy wypadnie 6 rzut jest powtórzony
if (wszytkie kostki miały wartość 5) {
	wykonanie czynnosci zakończone krytyczną porażką 
} else if (co najmniej jedna kostka miała wartość 1) {
	wykonanie czynnosci zakończone sukcesem
} else {
	wykonanie czynnosci zakończone porażką
}
```

Przykład:
```
check ability Johan JQuery PHY Lore Medicine
The Oracle: The result: critical failure
```

## Wyrazy uznania
Zadanie wzorowane jest doskonałym systemem RPG [CRAM](http://onepagerpg.com/files/CRAM.pdf), którego autorem jest  Rusty Gerard.



