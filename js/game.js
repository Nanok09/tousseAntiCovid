
//Syntaxe pour la classe valable avec ES6, voir compatibilité https://caniuse.com/#feat=es6-class
class Game 
{
  constructor(affichage = true, plateau) 
  {
    this.cases = [];
    //tableau qui représente le nombre de graines dans chaque case
    // Id des cases [ 0] [ 1] [ 2] [ 3] [ 4] [ 5]
    //              [11] [10] [ 9] [ 8] [ 7] [ 6]
    this.plateau = plateau;//élément html contenant le plateau (<div id="plateau"></div>)
    this.affichage = affichage;

      for (var i = 0; i < 12; i++) 
      {
        this.cases.push(4);
      }
      this.tour = 0; //les 2 joueurs sont 0 et 1
      this.me = 0;
      this.taken = [0, 0];//nombre de graines prises par chacun des deux joueurs
      //this.taken[0] : par le joueur 0, this.taken[1] par le joueur 1
      this.over = false;//partie terminée ou non

    if (this.affichage) 
    {
      this.initDisplay();//initialisation de l'affichage graphique
    }
  }

  initDisplay() 
  {
    //ajoute aux cases le bon nombre de graines initiales
    for (var i = 0; i < this.cases.length; i++) 
    {
      this.plateau.find('div.case[data-case-id="' + i + '"] div.conteneur_graines').html(new Array(this.cases[i] + 1).join('<div class="graine"></div>'));
    }
    //affiche les scores initiaux sur l'interface
    for (var j = 0; j < this.taken.length; j++) 
    {
      this.setScore(j);
    }
    var that = this;
    //évènement au click sur un élément de classe "case"
    $('div.case').on('click', function() {
      var id_case = parseInt($(this).attr('data-case-id'));
      var joueur = that.getJoueur(id_case);
      that.play(joueur, id_case, false);
      //jouer la case sur laquelle l'utilisateur a cliqué
    });
  }
  //ajoute nombre graines à la case id_case et met à jour l'interface
  //s'il y a plus de 10 graines dans une case, on affiche le nombre en chiffres plutôt que les graines
  ajouterGraines(id_case, nombre) 
  {
    this.cases[id_case] += nombre;
    if (this.affichage) 
    {
      if (this.cases[id_case] > 10) 
      {
        this.plateau.find('div.case[data-case-id="' + id_case + '"] div.conteneur_graines').html(this.cases[id_case]);
      } 
      else 
      {
        this.plateau.find('div.case[data-case-id="' + id_case + '"] div.conteneur_graines').html(new Array(this.cases[id_case] + 1).join('<div class="graine"></div>'));
      }
    }
  }
  //retire toutes les graines d'une case
  //affiche une animation sur les graines prises (fade out) si animate=true
  retirerGraines(id_case, animate = false) 
  {
    var graines = this.cases[id_case];
    this.cases[id_case] = 0;
    if (this.affichage) 
    {
      if (animate) 
      {
        var that = this;
        this.plateau.find('div.case[data-case-id="' + id_case + '"] div.conteneur_graines div.graine').fadeOut("slow", function() {
          that.plateau.find('div.case[data-case-id="' + id_case + '"] div.conteneur_graines').html('');
        });
      } 
      else 
      {
        this.plateau.find('div.case[data-case-id="' + id_case + '"] div.conteneur_graines').html('');
      }
    }
    return graines;
  }
  //capture une case
  capturerGraines(joueur, id_case) 
  {
    this.taken[joueur] += this.retirerGraines(id_case, true);
    //si un joueur a plus de 25 graines, il a gagné
    //@TODO Sur l'appli la partie semble continuer même si un joueur atteint 25 graines ? A vérifier
    if (this.taken[joueur] >= 25) 
    {
      //la partie est terminée et on définit le vainqueur
      this.over = true;
      this.winner = joueur;
      //@TODO Afficher le message sur l'interface
      console.log('Partie gagnée par joueur ' + joueur);
    }
    if (this.affichage) 
    {
      //affiche une ombre rouge sur la case capturée
      this.plateau.find('div.case[data-case-id="' + id_case + '"]').addClass('taken');
      //met à jour le nombre de graines capturées
      this.setScore(joueur);
    }
  }

  //retourne le joueur (0 ou 1) à qui appartient l'id de la case ou -1 si la case n'existe pas
  getJoueur(id_case) 
  {
    if (id_case <= 11 && id_case >= 6) 
    {
      return 0;
    } 
    else if (id_case <= 5 && id_case >= 0) 
    {
      return 1;
    } 
    else 
    {
      return -1; //case non valide
    }
  }

  //retourne un booléen indiquant si la case est prenable (contient 2 ou 3 graines)
  isCasePrenable(id_case) 
  {
    return (this.cases[id_case] == 2 || this.cases[id_case] == 3);
  }

  //id de la case suivante (rotation sens trigo)
  getCaseSuivante(id_case) 
  {
    return ((id_case - 1) < 0 ? (this.cases.length - 1) : (id_case - 1));
  }

  //id de la case précédente (rotation sens horaire)
  getCasePrec(id_case) 
  {
    return ((id_case + 1) > this.cases.length - 1 ? 0 : (id_case + 1));
  }

  verifAffamer(joueur, id_case) 
  {
    var curr_case = (joueur == 0 ? 11 : 5);
    var i = 0;
    while (this.cases[curr_case] == 0 && i < 6) 
    {
      i += 1;
      curr_case = this.getCaseSuivante(curr_case);
    }
    if (i == 6) 
    {
      var cases_possibles = this.getCasesNourrir(joueur);
      if (cases_possibles.length == 0) 
      {
        //fin du jeu
        this.over = true;
        //Prendre toutes les cases de joueur et définir le vainqueur
        var curr_case = (joueur == 0 ? 11 : 5);
        var i = 0;
        while (i < 6) 
        {
          if (this.cases[curr_case] > 0) 
          {
            this.capturerGraines(joueur, curr_case);
          }
          i += 1;
          curr_case = this.getCaseSuivante(curr_case);
        }
        this.winner = (this.taken[0] < this.taken[1] ? 1 : 0);
        //@TODO Afficher sur l'interface
        console.log('Partie terminée');
        return true;
      } 
      else if (cases_possibles.indexOf(id_case) !== -1) 
      {
        return false;
      } 
      else 
      {
        return true;
      }
    } 
    else 
    {
      return false;
    }
  }
  verifVaAffamer(joueur, id_case) 
  {
    //verifie si les cases de joueur sont toutes prenables si autre_joueur joue id_case
    var curr_case = (joueur == 0 ? 6 : 0);
    var i = 0;
    var k = 0;
    while (k < 6) 
    {
      k += 1;
      if ((((joueur == 1) && (curr_case >= id_case)) || ((joueur == 0) && (curr_case <= id_case)))) 
      {
        if (this.isCasePrenable(curr_case)) 
        {
          i += 1;
        }
      } 
      else 
      {
        if (this.cases[curr_case] == 0) 
        {
          i += 1;
        }
      }
      curr_case = this.getCasePrec(curr_case);
    }
    return (i == 6);
  }

  //renvoie les cases que peut jouer adversaire pour nourrir joueur
  getCasesNourrir(joueur) 
  {
    var curr_case = (joueur == 0 ? 5 : 11);
    var cases_possibles = [];
    var i = 0;
    var distance = 6;
    while (i < 6) 
    {
      if (this.cases[curr_case] >= distance) 
      {
        cases_possibles.push(curr_case);
      }
      distance -= 1;
      i += 1;
      curr_case = this.getCaseSuivante(curr_case);
    }
    return cases_possibles;
  }

  setScore(joueur) 
  {
    this.plateau.find('div.score[data-player-id="' + joueur + '"]').html('<div class="graine"></div><span class="affichageScore">Graines capturées : </span>' + this.taken[joueur]);
  }

  play(joueur, id_case) 
  {
    if (!this.over && this.tour == joueur && this.getJoueur(id_case) == joueur && this.cases[id_case] > 0) 
    {
      var autre_joueur = (joueur + 1) % 2;
      //Règle : obligation de nourrir l'adversaire s'il n'en a plus dans son camp
      if (this.verifAffamer(autre_joueur, id_case)) 
      {
        //@TODO Afficher sur l'interface
        console.log("Il ne faut pas affamer l'adversaire");
      } 
      else 
      {
        if (this.affichage) 
        {
          this.plateau.find('div.case.taken').removeClass('taken');
        }
        var graines = this.retirerGraines(id_case);
        var curr_case = id_case;
        while (graines > 0) 
        {
          curr_case = this.getCaseSuivante(curr_case);
          if (curr_case !== id_case) 
          {
            this.ajouterGraines(curr_case, 1);
            graines -= 1;
          }
        }
        //vérifier qu'on ne va pas affamer l'adversaire
        //sinon on n'effectue aucune prise
        if (!(this.verifVaAffamer(autre_joueur, curr_case))) 
        {
          while (this.getJoueur(curr_case) == autre_joueur && this.isCasePrenable(curr_case)) 
          {
            this.capturerGraines(joueur, curr_case);
            curr_case = this.getCasePrec(curr_case);
          }
        } 
        else 
        {
          //@TODO Afficher sur l'interface
          console.log("Les cases n'ont pas été prises pour ne pas affamer l'adversaire")
        }
        this.tour = autre_joueur;
      }
    } 
    else 
    {
      //@TODO Afficher sur l'interface
      console.log('Coup non valide');
    }
  }
}

var partie;

$(function() 
{
  partie = new Game(true, $('#jeuPlateau'));
});
