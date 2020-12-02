<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ORMController extends AbstractController
{
    /**
     * @Route("/orm", name="orm_index")
     */
    public function index(): Response
    {
        /** @var LivreRepository $repository */
        $repository = $this->getDoctrine()->getRepository(Livre::class);
        // $livres = $repository->findAll();
        $livres = $repository->findAllJoinGenre();

        return $this->render('orm/index.html.twig', [
            'livres' => $livres
        ]);
    }

    /**
     * @Route("/orm/detail/{id}", name="orm_detail")
     */
    public function detail($id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Livre::class);
        // $livre = $repository->find($id);
        $livre = $repository->findOneJoinGenre($id);

        return $this->render('orm/detail.html.twig', [
            'livre' => $livre
        ]);
    }


    /**
     * @Route("/orm/add", name="orm_add")
     */
    public function add(Request $request): Response
    {
        $livre = new Livre();
        $livre->setTitre("La Symphonie des siècles");
        $livre->setResume("<p>Serendair est une île perdue, terre natale de Rhapsody. Le nom \"Serendair\" était originellement composé de deux parties - Seren Dair - qui littéralement signifie 'La Terre de l'Etoile'. Cette Île fut l'endroit où le temps commença, où les anciens Serennes nés des étoiles (ou de l'Ether comme cela est dit dans le livre) s'installèrent. </p><p>Tôt dans l'histoire de Serendair, une étoile tomba du ciel et enleva une grande partie de sa masse à l'Île. Tandis que la race des Hommes prospérait sur l'Île, l'étoile au fond de l'océan fut appelée 'L'Enfant Endormi', et le peuple croyait qu'elle sortirait un jour des abysses pour finir d'emporter l'Île. </p><p>La prédiction se réalisa bien durant de règne du Roi Gwylliam, mais ce dernier avait prévu cette destruction et des années avant la catastrophe, il avait envoyé un grand explorateur nommé Merithyn, pour trouver une terre inhabitée sur laquelle la culture et le peuple Serenne pourrait être préservés après la mort de Serendair Merithyn accosta sur la berge du royaume d'Elynsynos, un dragon. Elle avait alors perdu sa forme reptilienne et s'était transformée en une femme serenne. L'Explorateur et la Dragonne étaient alors tombés amoureux. Ce fut grâce à leur amour que la flotte serenne put aborder la terre du Dragon sans craindre sa fureur. Mais Merithyn périt pendant le voyage et quand le premier bateau apporta la mauvaise nouvelle, Elynsynos se retira folle de douleur dans sa grotte.</p><p>Presque toutes les races originaires de Serendair étaient représentées dans un des trois bateaux qui constituait la flotte serenne. Mais de nombreuses anciennes races, comme les Lirins restèrent en arrière, utilisant leurs derniers jours à chanter pour Sagia, l'Arbre Monde, considéré comme sacré par le peuple des Lirins. Une toute nouvelle civilisation se créa sur ces nouvelles terres, où arrivera Rhapsody, des siècles plus tard...</p>");
        $livre->setParution(new \DateTime("2008-09-08"));

        // queryString => localhost:8000/orm?action=save
        if ( "save" == $request->query->get('action') ) {
            // save in database
            // Entity Manager (em) est l'objet responsable de la insertion, modification
            // et suppression des données dans la base de donnée
            $em = $this->getDoctrine()->getManager();
            // La méthod persist met en mémoire une entité à sauvegarder (insert/update)
            $em->persist($livre);
            $em->flush();

            $this->addFlash('success', 'Votre livre a bien été ajouté');

            return $this->redirectToRoute('orm_index');
        }

        return $this->render('orm/add.html.twig', [
            'livre' => $livre
        ]);
    }
}
