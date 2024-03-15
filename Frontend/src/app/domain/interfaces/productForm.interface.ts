import { FormControl } from "@angular/forms";

export interface ProductFormInterface{
  code:FormControl<string>;
  name:FormControl<string>;
  categoryId:FormControl<number>;
  price:FormControl<number>;  
}