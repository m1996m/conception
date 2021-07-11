export class PersonnelModel {
    constructor(
        public nom: string,
        public prenom: string,
        public dateNaissance: string,
        public image: string,
        public genre: string,
        public adresse: string,
        public telephone: number,
        public profession: string,
        public fonction: string,
        public specialite: string
        ){}
}