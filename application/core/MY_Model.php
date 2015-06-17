<?php

class MY_Model extends CI_Model {

  public function find($filter = array(), $order = array('id' => 'DESC'), $offset = 0, $per_page = 2000, $filter_not = array()) {

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $criteria = new \Doctrine\Common\Collections\Criteria();

    if (count($filter) > 0) {
      foreach ($filter as $key => $value) {
        $criteria->where($criteria->expr()->eq($key, $value));
      }
    }

    $criteria->orderBy($order);
    $criteria->setFirstResult($offset);
    $criteria->setMaxResults($per_page);

    if (count($filter_not) > 0) {

      foreach ($filter_not as $filter_key => $filter_value) {
        if (is_array($filter_value)) {
          foreach ($filter_value as $filter_value_key => $filter_value_value) {
            $criteria->andWhere($criteria->expr()->neq($filter_value_key, $filter_value_value));
          }
        } else {
          $criteria->andWhere($criteria->expr()->neq($filter_key, $filter_value));
        }
      }
    }

    return $query->matching($criteria);

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

  public function count($filter = array(), $filter_not = array()) {

    $query = $this->doctrine->em->getRepository("Entity\\" . get_class($this));
    $criteria = new \Doctrine\Common\Collections\Criteria();

    if (count($filter) > 0) {
      foreach ($filter as $key => $value) {
        $criteria->where($criteria->expr()->eq($key, $value));
      }
    }

    if (count($filter_not) > 0) {

      foreach ($filter_not as $filter_key => $filter_value) {
        if (is_array($filter_value)) {
          foreach ($filter_value as $filter_value_key => $filter_value_value) {
            $criteria->andWhere($criteria->expr()->neq($filter_value_key, $filter_value_value));
          }
        } else {
          $criteria->andWhere($criteria->expr()->neq($filter_key, $filter_value));
        }
      }
    }

    return count($query->matching($criteria));

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
