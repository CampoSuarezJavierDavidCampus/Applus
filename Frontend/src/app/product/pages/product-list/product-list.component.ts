import { Component, OnInit } from '@angular/core';
import { ProductInterface } from '@domain/interfaces/product.interface';
import { ProductDtoInterface } from '@domain/interfaces/productDto.interface';
import { ProductoService } from '@services/producto.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrl: './product-list.component.css'
})
export class ProductListComponent implements OnInit {
  products$:Observable<ProductInterface[]>|null = null;
  showList:boolean = true;
  showCreateForm:boolean = false;
  showUpdateForm:boolean = false;
  showConfirm:boolean = false;
  selectedProduct:ProductDtoInterface|null = null;


  constructor(
    private service:ProductoService
  ) {}
  ngOnInit(): void {
    this.products$ = this.service.Data;
  }

  create(product:ProductDtoInterface){
    this.service.Create = product;
  }

  update(product:ProductDtoInterface){
    this.service.Edit = product;
  }

  delete(code:string){
    this.service.Delete = code;
  }

  Cancel(){
    this.showList = true;
    this.showCreateForm = false;
    this.showUpdateForm = false;
    this.showConfirm = false;
  }

  selectingProduct(product:ProductInterface, type:string){

    if(type == 'delete'){
      this.showList = false;
      this.showCreateForm = false;
      this.showUpdateForm = false;
      this.showConfirm = true;
    }else{
      this.showList = false;
      this.showCreateForm = false;
      this.showUpdateForm = true;
      this.showConfirm = false;
    }
    this.selectedProduct = {
      code : product.code,
      name : product.name,
      categoryId : product.category.id,
      price : product.price
    } as ProductDtoInterface;
  }

}
