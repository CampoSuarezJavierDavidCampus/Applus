import { CategoryInterface } from "./category.interface";
import { TimeInterface } from "./time.interface";

export interface ProductInterface{
  code:string;
  name:string;
  category:CategoryInterface
  price:number;
  createAt:TimeInterface,
  updateAt:TimeInterface,
}