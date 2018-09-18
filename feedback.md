## :wave: feedback :eyeglasses:

Tres bon travail dans l'ensemble , il y a un petit peu de travail sur le coté algorithmique et le découpage de ton application mais sinon c'est nickel ;)

### Retours

Code bien propre et bien indenté dans l'ensemble cependant attention à l'indentation dans les vues et l'aeration de ton code ;)

Bien la nomenclature fonction , variable et nom de classe !

Bon usage de static

Attention au découpage de tes controllers qui ne doivent traiter *que* des fonctionnalité du site à proprement parlé ou de ce qui les concernent directement :

- La fonction shuffle devrait se trouver a l'endroit ou l'on en a besoin soit dans notre model.
- La fonction / action account concerne l'utilisateur non le quizz ;)
-
Bien le shuffle !

Il faut essayer de separer tes traitement de la vue , ceux ci sont à faire coté model pour la manipulation des données et dans le controller pour préparer l'affichage. Ceci peux se faire en passant par des variables tampon. (ex list-form)

N'hésites pas à utiliser des expressions ternaires dans le cas où ta variable prend *toujours* dans un cas comme dans l'autre une valeur (lisibilité ++)

Voir commentaires list-form.php
