<?php

class MY_Model extends CI_Model {

  public function find($filter = array(), $order = array('id' => 'DESC'), $offset = 0, $per_page = 2000) {

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    return $query->findBy($filter, $order, $per_page, $offset);

  }

  public function select_opts($filter = array()) {

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $options = array('' => 'Selecione', ' ' => ' ');

    if (count($filter) > 0) {
      $results = $query->findBy($filter);
    } else {
      $results = $query->findAll();
    }

    foreach ($results as $row) {
    	$options[$row->getId()] = $row->getNome();
    }

    return $options;

  }

  public function count($filter = array()) {

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    return count($query->findBy($filter));

  }

  public function update($id, $name, $value) {

    try {
      $object = $this->doctrine->em->getRepository("Entity\\" . $name);
      $object = $object->findBy(array('id' => $value))[0];
      $value = $object;
    } catch (Doctrine\Common\Persistence\Mapping\MappingException $e) {
      // O valor passado para ser atualizado não é uma entidade
    }

    // Localizando o registro a ser atualizado
    $entity = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $object = $entity->findBy(array('id' => $id))[0];

    $name = "set$name";
    $object->$name($value);

    $this->doctrine->em->persist($object);
    $this->doctrine->em->flush();

  }

}
