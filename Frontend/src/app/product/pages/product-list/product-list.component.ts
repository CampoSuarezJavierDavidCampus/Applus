import { Component, OnInit } from '@angular/core';
import { ProductInterface } from '@domain/interfaces/product.interface';
import { ProductDtoInterface } from '@domain/interfaces/productDto.interface';
import { State } from '@domain/models/state';
import { ProductoService } from '@services/producto.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrl: './product-list.component.css'
})



export class ProductListComponent implements OnInit {
  products$:Observable<ProductInterface[]>|null = null;
  states:State = (new State());
  selectedProduct:ProductDtoInterface|null = null;


  constructor(
    private service:ProductoService
  ) {}
  ngOnInit(): void {
    this.loadProducts();
    this.states.showList = true;
  }

  loadProducts(){
    this.products$ = this.service.Data;
  }

  create(product:ProductDtoInterface){
    this.service.Create = product;
    this.loadProducts();
    this.Cancel();
  }

  update(product:ProductDtoInterface){
    this.service.Edit = product;
    this.loadProducts();
    this.Cancel();
  }

  delete(code:string){
    console.log(code);
    this.service.Delete = code;
    this.loadProducts();
    this.Cancel();
  }

  Cancel(){
    this.states = new State();
    this.states.showList= true;
  }

  showCreate(){
    this.states = new State();
    this.states.showCreateForm= true;
  }

  selectingProduct(product:ProductInterface, type:string){
    this.states = new State();

    if(type == 'delete'){
      this.states.showConfirm= true;
    }else{
      this.states.showUpdateForm= true;
    }
    this.selectedProduct = {
      code : product.code,
      name : product.name,
      categoryId : product.category.id,
      price : product.price
    } as ProductDtoInterface;
  }

}
