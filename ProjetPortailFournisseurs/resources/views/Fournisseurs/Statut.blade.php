<div class="container-fluid"  id="Contact">
                                <div class="row">
                                    <div class="p-3 col-4">
                                        <label class="beaulabel" for="personneContact">Personne Contact : </label>
                                        <input class="form-control" type="personneContact" id="personneContact" name="personneContact[]">
                                    </div>

                                    <div class="col-4 align-self-center text-center">
                                        <div id="PhonePersonnel">
                                            <div class="phone-number-container col-12">
                                                <label class="beaulabel" for="phone1">Telephone Personnel</label>
                                                <select name="phone[]" class="phone">
                                                    <option value="Bureau">Bureau</option>
                                                    <option value="Domicile">Domicile</option>
                                                    <option value="Cellulaire">Cellulaire</option>
                                                </select>
                                                <input class="form-control" type="text" name="personneContact[]" min="10" max="12" required>
                                            </div>
                                        </div>
                                    </div>

                                <div class="p-3 col-4">
                                    <label class="beaulabel" for="email">Courriel : </label><br>
                                    <input class="form-control input" type="email" id="email" name="personneContact[]">
                                </div>
                                </div>
                            </div>