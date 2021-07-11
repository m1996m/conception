export class UserModel{
    constructor(
        public id: number,
        public userName: string,
        public email: string,
        public password: string,
        public confirmation: string
        ){}
 }