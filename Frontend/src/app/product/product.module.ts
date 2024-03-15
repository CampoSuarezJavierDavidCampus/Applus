import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProductEditComponent } from './pages/product-edit/product-edit.component';
import { ProductCreateComponent } from './pages/product-create/product-create.component';
import { ProductListComponent } from './pages/product-list/product-list.component';
import { ProductoService } from '@services/producto.service';
import { HttpClientModule } from '@angular/common/http';
import { ReactiveFormsModule } from '@angular/forms';
import { ProductConfirmComponent } from './pages/product-confirm/product-confirm.component';



@NgModule({
  declarations: [
    ProductEditComponent,
    ProductCreateComponent,
    ProductListComponent,
    ProductConfirmComponent
  ],
  imports: [
    CommonModule,
    HttpClientModule,
    ReactiveFormsModule
  ],
  providers:[
    ProductoService
  ],
  exports:[
    ProductListComponent
  ]
})
export class ProductModule { }
