import { TimeInterface } from "./time.interface";

export interface CategoryInterface{
  id:number;
  name:string;
  createAt:TimeInterface,
  updateAt:TimeInterface,
}