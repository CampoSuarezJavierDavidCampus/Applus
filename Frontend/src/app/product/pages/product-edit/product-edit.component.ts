import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ProductInterface } from '@domain/interfaces/product.interface';
import { ProductDtoInterface } from '@domain/interfaces/productDto.interface';
import { ProductFormInterface } from '@domain/interfaces/productForm.interface';
import { ProductoService } from '@services/producto.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-product-edit',
  templateUrl: './product-edit.component.html',
  styleUrl: './product-edit.component.css'
})
export class ProductEditComponent implements OnInit{

  @Input({required:true}) product!:ProductDtoInterface;
  @Output() onChange = new EventEmitter<ProductDtoInterface>;
  @Output() onCancel = new EventEmitter;
  message:string = '';
  productForm = new FormGroup<ProductFormInterface>({
    code : new FormControl('',{nonNullable:true,validators:Validators.required}),
    name : new FormControl('',{nonNullable:true,validators:Validators.required}),
    categoryId : new FormControl(0,{nonNullable:true,validators:Validators.required}),
    price : new FormControl(0,{nonNullable:true,validators:Validators.required}),
  })

  ngOnInit(): void {
    this.productForm.controls.code.setValue(this.product.code);
    this.productForm.controls.name.setValue(this.product.name);
    this.productForm.controls.categoryId.setValue(this.product.categoryId);
    this.productForm.controls.price.setValue(this.product.price);
  }

  save(){
    if(this.productForm.invalid){
      this.message = "campo incorrecto"
      return;
    }

    this.onChange.emit( {
      code : this.productForm.controls.code.value,
      name : this.productForm.controls.name.value,
      categoryId : this.productForm.controls.categoryId.value,
      price : this.productForm.controls.price.value,
    } as ProductDtoInterface);
  }

}
