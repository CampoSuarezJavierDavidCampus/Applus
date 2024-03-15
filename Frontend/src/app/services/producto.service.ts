import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { ProductInterface } from '@domain/interfaces/product.interface';
import { ProductDtoInterface } from '@domain/interfaces/productDto.interface';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProductoService {
  private apiUrl = 'http://localhost:8000/product'

  constructor(
    private http:HttpClient
  ) {}

  public get Data():Observable<ProductInterface[]>{
    return this.http.get<ProductInterface[]>(
      this.apiUrl)
  }
  public set Create(product:ProductDtoInterface){
    this.http.post(this.apiUrl,product);
  }
  public set Edit(product:ProductDtoInterface){
    this.http.put(this.apiUrl,product);
  }
  public set Delete(id:string){
    let params = new HttpParams();
    params = params.set('code',id);
    this.http.delete(this.apiUrl,{params});
  }
}
