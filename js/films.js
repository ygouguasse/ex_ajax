window.addEventListener("load", Initialiser);

function Initialiser() {
	document.getElementById("titre").addEventListener("blur", GererBlurDeInputTitre);
	document.getElementById("titre").addEventListener("keyup", GererKeyUpDeInputTitre);
}

function GererBlurDeInputTitre(event) {
	const titre = event.currentTarget.value;
	GererModificationDeInputTitre(titre);
}

function GererKeyUpDeInputTitre(event) {
	const titre = event.currentTarget.value;
	if (event.code === "Enter") {
		GererModificationDeInputTitre(titre);
		return;
	}
}

async function GererModificationDeInputTitre(titre) {
	CacherErreur();

	if (titre === "") {
		ReinitialiserTableInformationsFilm();
		return;
	}

	const films = await ObtenirFilms({"titre": titre});
	AfficherFilms(films);
}

function ReinitialiserTableInformationsFilm() {
	const table = document.getElementById("TableInfosFilm");
	const tbody = table.querySelector("tbody");

	tbody.innerHTML = "";
}

async function ObtenirFilms(donneesAEnvoyer) {
	try {
		const reponse = await fetch("index.php?action=ObtenirFilms", {
			method: "POST", // POST, DELETE, PUT
			headers: {
				// On indique qu'on envoie des données en JSON en utf-8
				"Content-Type": "application/json; charset=utf-8"
			},
			// Si donneesAEnvoyer = {"titre":"Fight Club"},
			// alors on envoie la string : '{"titre":"Fight Club"}'
			body: JSON.stringify(donneesAEnvoyer),
		});

		// reponse.ok === true si le code de réponse est 200
		// https://developer.mozilla.org/fr/docs/Web/HTTP/Status/200
		if (!reponse.ok) {
			if (reponse.status === 404) {
				throw new Error("Aucun film trouvé.");
			}
			throw new Error("Une erreur est survenue.");
		}

		// Ici, le serveur nous renvoie des données en JSON.
		// On récupère les données avec await reponse.json();
		return await reponse.json();

		} catch (erreur) {
			// Affiche le message d'erreur
			AfficherErreur(erreur);
			return [];
		}
}

function AfficherFilms(films) {
	const table = document.getElementById("TableInfosFilm");
	const tbody = table.querySelector("tbody");
	tbody.innerHTML = "";

	films.forEach(film => {
		// Notez que les $ n'ont rien à voir avec PHP.
		// https://developer.mozilla.org/fr/docs/Web/JavaScript/Reference/Template_literals
		tbody.innerHTML += `
			<tr>
				<td>${film["titre"]}</td>
				<td>${film["realisateur"]}</td>
				<td>${film["duree_minutes"]}</td>
				<td>${film["annee_sortie"]}</td>
				<td>${film["genres"]}</td>
			</tr>
		`;
	});
}

function CacherErreur() {
	const conteneur = document.getElementById("conteneur_alerte");
	conteneur.innerHTML = "";
}

function AfficherErreur(erreur) {
	const conteneur = document.getElementById("conteneur_alerte");
	conteneur.innerHTML = `
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			${erreur.message}
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	`;
}