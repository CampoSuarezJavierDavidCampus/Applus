import { Component, EventEmitter, Output } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ProductDtoInterface } from '@domain/interfaces/productDto.interface';
import { ProductFormInterface } from '@domain/interfaces/productForm.interface';

@Component({
  selector: 'app-product-create',
  templateUrl: './product-create.component.html',
  styleUrl: './product-create.component.css'
})
export class ProductCreateComponent {
  @Output() onSave = new EventEmitter<ProductDtoInterface>;
  @Output() onCancel = new EventEmitter;
  message:string = '';
  productForm = new FormGroup<ProductFormInterface>({
    code : new FormControl('',{nonNullable:true,validators:Validators.required}),
    name : new FormControl('',{nonNullable:true,validators:Validators.required}),
    categoryId : new FormControl(1,{nonNullable:true,validators:Validators.required}),
    price : new FormControl(0,{nonNullable:true,validators:Validators.required}),
  })

  save(){
    if(this.productForm.invalid){
      this.message = "campo incorrecto"
      return;
    }

    this.onSave.emit( {
      code : this.productForm.controls.code.value,
      name : this.productForm.controls.name.value,
      categoryId : this.productForm.controls.categoryId.value,
      price : this.productForm.controls.price.value,
    } as ProductDtoInterface);
  }


}
