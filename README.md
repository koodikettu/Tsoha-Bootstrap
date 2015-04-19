# Tietokantasovelluksen esittelysivu

Yleisiä linkkejä:

* [Linkki sovellukseeni](https://marklaak.users.cs.helsinki.fi/ystavapalvelu)
* [Linkki dokumentaatiooni](https://www.github.com/koodikettu/Ystavapalvelu/blob/master/doc/Dokumentaatio.pdf)

## Työn aihe

Laita tähän aihekuvaus tai [linkki valmiiseen aiheeseen](http://advancedkittenry.github.io/suunnittelu_ja_tyoymparisto/aiheet/Ystavanvalityspalvelu.html) 

## Toteutetut sivut

* Esittelysivu (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/etusivu)
* Julkinen profiili (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/esittely_julkinen)
* Profiilin muokkaus (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/profiilin_muokkaus)
* Tulosten listaus (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/tulosten_listaus)
* Kirjautuminen (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/kirjautuminen)
* Rekisteröityminen (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/rekisteroityminen)
* Viestien listaus (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/viestien_listaus)
* Viestin lähettäminen (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/viestin_lahettaminen)
* Viestiin vastaaminen (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/viestiin_vastaaminen)
* Ylläpitäjän käyttäjälistaus (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/yllapitajan_kayttajalistaus)

## 3. viikon palautuksen toiminnallisuutta sisältävät sivut:
* Rekisteröityminen (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/rekisteroityminen)
* Ylläpitäjän käyttäjälistaus (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/yllapitajan_kayttajalistaus)
* Ylläpitäjän näkemä käyttäjäsivu (http://marklaak.users.cs.helsinki.fi/ystavapalvelu/kayttaja/av_dude)

## 4. viikon palautuksen vaatimukset löytyvät sovelluksesta seuraavasti:
CRUD-nelikko on toteutettu tietokohteelle Asiakas.

Uuden asiakkaan luominen:
http://marklaak.users.cs.helsinki.fi/ystavapalvelu/rekisteroityminen
Rekisteröitymisen yhteydessä on toteutettu myös mallin validoiminen.

Asiakkaan tietojen listaus, muuttaminen ja poistaminen on tällä hetkellä toteutettu ainoastaan ylläpitäjän käyttöliittymistä:
http://marklaak.users.cs.helsinki.fi/ystavapalvelu/yllapitajan_kayttajalistaus

Kirjautuminen on toteutettu tällä hetkellä ainoastaan ylläpitäjäkäyttäjälle.
Ylläpitäjän kirjautuminen onnistuu navigaatiopaneelin oikeassa laidassa olevasta kirjautumispainikkeesta. Samaan kohtaan tulee kirjautuneelle ylläpitäjälle logout-painike. Ylläpitäjän kirjautuminen testataan ylläpitäjän käyttäjälistausnäkymässä (edellinen linkki).

Kirjautuminen onnistuu seuraavilla tunnuksilla:

käyttäjätunnus: admin

salasana: anasalas

Erittäin alustava käyttöohje löytyy repositorion doc-kansiosta nimellä kayttoohje.md 

## Viikko 5 ##

1. Toteutettu uloskirjautuminen ja estetetty kirjautumattoman käyttäjän pääsy sivuille, jotka ovat vain kirjautuneille käyttäjille.
Kirjautumissivut:
Ylläpitäjä:
http://marklaak.users.cs.helsinki.fi/ystavapalvelu/yllapitajan_kayttajalistaus
Käyttäjä
http://marklaak.users.cs.helsinki.fi/ystavapalvelu/
Käyttäjätilejä voi testata esim. seuraavilla käyttäjätunnuksilla
käyttäjätunnus: av_dude, salasana 123456
käyttäjätunnus: bb-mint, salasana 123456

2. Toteutettu uusi tietokohde Viesti
Käyttäjä voi lähettää viestin toiselle käyttäjälle kirjautumalla sisään, hakemalla muut käyttäjät, menemällä käyttäjän tietonäkymään ja kirjoittamalla viestin sen alaosassa olevaan lomakkeeseen.
Tällä hetkellä viestit eivät vielä näy käyttäjille, mutta ne näkyvät ylläpitäjälle. Ylläpitäjän on kirjauduttava sisään ja valittava painike viestilistaus, jolloin näytetään kaikki järjestelmään talletetut viestit.
