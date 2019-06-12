import { Observable } from 'rxjs';
import { Injectable } from '@angular/core';
import { Company } from './../models/company.model';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '../../../environments/environment';
@Injectable({
  providedIn: 'root'
})
export class CompanyService {

  noAuthHeader = { headers: new HttpHeaders({ NoAuth: 'True' }) };
  selectedCompany: Company = new Company();
  companies: Company[];

  constructor(private http: HttpClient) { }

  saveCompany(company: Company) {
    return this.http.post(environment.apiBaseUrl + '/savecompany', company);
  }

  getCompanyList() {
    return this.http.get(environment.apiBaseUrl + '/loadcompany');
  }

  updateCompany(company: Company) {
    return this.http.post(environment.apiBaseUrl + '/updatecompany', company);
  }

  deleteCompany(id: string) {
    return this.http.delete(environment.apiBaseUrl + '/deletecompany' + `/${id}`);
  }

  getCompany(id: string) {
    return this.http.get(environment.apiBaseUrl + '/getcompany' + `/${id}`);
  }

}
